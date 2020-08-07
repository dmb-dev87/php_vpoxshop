<?php
class ProxySMTP{
         //Proxy server ip
    public $proxyHost;
         / / proxy server port
    public $proxyPort;
         / / Proxy server username
    public $proxyUsername;
         / / proxy server password
    public $proxyPassword;
         //smtp domain name (cannot be ip) ip needs to change the proxy message prefix 5 1 0 3 changed to 5 1 0 1
    public $smtpHost;
         //smtp port
    public $smtpPort;
         //smtp username
    public $smtpUsername;
         //smtp authorization code
    public $smtpPassword;
         //mail title 
    public $title;
         //Sender's mailbox
    public $from;
         / / recipient mailbox
    public $to;
         / / mail body
    public $content;
         //Attachment effective access path
    public $attachment='';
         //related variables of the attachment
    protected $file_name;
    protected $file_type;
    protected $file_ext;
         //smtp judges the end of the command carriage return + line feed
    protected $CRLF="\r\n";
         //socket handle
    private $sock;
         //socks server connected to smtp server status
    private $connectSMTP=false;

    /**
           * Connect to the proxy server and let the proxy server connect to the smtp server
     *
     *
     * */
    protected function connect()
    {
        $this->sock = pfsockopen($this->proxyHost,$this->proxyPort,$errno,$errbuf, 60);
        if(!$this->sock){
                         //Connection failed 
                         Return ['status'=>false,'errno'=>$errno,'errstr'=>$errbuf,'msg'=>'socks server connection failed'];
        }
        fwrite($this->sock, pack("C3", 0x05, 0x01, 0x02));
        if(fread($this->sock,512)!==pack('C2',0x05,0x02)){
                         //socks server does not support password authentication mode
                         Return ['status'=>false,'errno'=>$errno,'errstr'=>$errbuf,'msg'=>'socks server does not support password authentication mode'];
        }
        fwrite($this->sock, pack('C2',0x01,strlen($this->proxyUsername)).$this->proxyUsername.pack('C1',strlen($this->proxyPassword)).$this->proxyPassword);
        if(fread($this->sock,512)!==pack('C2',0x01,0x00)){
                         //socks server account password authentication failed
                         Return ['status'=>false,'errno'=>$errno,'errstr'=>$errbuf,'msg'=>'socks server account password authentication failed'];
        }
        fwrite($this->sock, pack("C5", 0x05 , 0x01 , 0x00 , 0x03, strlen($this->smtpHost)).$this->smtpHost.pack("n", $this->smtpPort));
        if(substr(fread($this->sock,512),0,4)!==pack('C4',0x05,0x00,0x00,0x01)){
                         //socks server failed to connect to smtp server
                         Return ['status'=>false,'errno'=>$errno,'errstr'=>$errbuf,'msg'=>'socks server connection smtp server failed'];
        }else{
            $return=fread($this->sock,512);
            if(substr($return,0,3)!='220'){
                                 //smtp connection error
                return ['status'=>false,'errno'=>$errno,'errstr'=>$errbuf,'msg'=>$return];
            }
            $this->connectSMTP=true;
            return ['status'=>true];
        }
    }

    /**
           *Check if the mandatory field is set
     *
     *
     * */
    protected function beforeSend(){
        $reflect =new \ReflectionClass($this);
        $arg=$reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach($arg as $v){
            if($v->getName()!='attachment'){
                if(!$v->getValue($this)){
                                         Return ['status'=>false, 'msg'=>$v->getName(). 'Cannot be empty'];
                }
            }
        }
        return ['status'=>true];
    }

    /**
           * Send mail method, connect proxy server, let proxy server connect to smtp server and send permission to send
     *
     *
     * */
    public function send()
    {
        $beforeSendCheck=$this->beforeSend();
        if(!$beforeSendCheck['status']){
            return $beforeSendCheck;
        }
        $connectStatus=$this->connect();
        if(!$connectStatus['status']){
            return $connectStatus;
        }
        $authStatus=$this->smtpAuth();
        if(!$authStatus['status']){
            return $authStatus;
        }
        $headerStatus=$this->smtpHeader();
        if(!$headerStatus['status']){
            return $headerStatus;
        }
        $bodyStatus=$this->smtpBody();
        if(!$bodyStatus['status']){
            return $bodyStatus;
        }
                 Return ['status'=>true, 'msg'=> 'send successfully'];
    }

    /**
           * Email account password authentication
     *
     *
     * */
    protected function smtpAuth()
    {
        fputs($this->sock,'EHLO '.$this->smtpHost.$this->CRLF);
        fread($this->sock,512);
        fputs($this->sock,'STARTTLS auth login'.$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='220'){
                         / / does not support TLS
            return ['status'=>false,'msg'=>$return];
        }
        fputs($this->sock,'AUTH LOGIN'.$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='334'){
                         / / does not support TLS
            return ['status'=>false,'msg'=>$return];
        }
        fputs($this->sock,base64_encode($this->smtpUsername).$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='334'){
                         / / does not support TLS
            return ['status'=>false,'msg'=>$return];
        }
        fputs($this->sock,base64_encode($this->smtpPassword).$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='235'){
                         / / Account password authentication is not successful
                         Return ['status'=>false, 'msg'=> 'Account password authentication is not successful'];
        }
        return ['status'=>true];
    }

    /**
           * Set up mail senders and recipients
     *
     *
     * */
    protected function smtpHeader()
    {
        fputs($this->sock,'mail from:<'.$this->from.'>'.$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='250'){
                         //Send unsuccessful
                         Return ['status'=>false, 'msg'=> 'Sender's email sent unsuccessfully'];
        }
        fputs($this->sock,'rcpt to:<'.$this->to.'>'.$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='250'){
                         //Send unsuccessful
                         Return ['status'=>false, 'msg' => 'Recipient's mailbox is not sent successfully'];
        }
        return ['status'=>true];
    }

    /**
           * Set the message body
     *
     *
     * */
    protected function smtpBody()
    {
        fputs($this->sock,'data'.$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='354'){
                         //Send unsuccessful
                         Return ['status'=>false, 'msg'=> 'The text is not sent successfully'];
        }
        fputs($this->sock,'Return-path:<'.$this->from.'>'.$this->CRLF);
        fputs($this->sock,'Date:'.date('r').$this->CRLF);
        fputs($this->sock,'From:<'.$this->from.'>'.$this->CRLF);
        fputs($this->sock,'MIME-Version:1.0'.$this->CRLF);
        fputs($this->sock,'Subject:=?UTF-8?B?'.base64_encode(trim($this->title)).'?= '.$this->CRLF);
        fputs($this->sock,'To:<'.$this->to.'>'.$this->CRLF);
        if($this->attachment){
                         / / There are attachments
            $this->file_name=basename($this->attachment);
            $this->file_ext=$this->mb_pathinfo($this->file_name, PATHINFO_EXTENSION);
            $this->file_type=$this->_mime_types($this->file_ext);
            $boundary=$this->generateId();
            fputs($this->sock,'Content-type: multipart/mixed; boundary="'.$boundary.'"'.$this->CRLF.$this->CRLF);
            fputs($this->sock,'This is a multi-part message in MIME format.'.$this->CRLF);
            fputs($this->sock,'--'.$boundary.$this->CRLF);
            fputs($this->sock,'Content-type:text/plain; charset=UTF-8'.$this->CRLF);
            fputs($this->sock,'Content-Transfer-Encoding:base64'.$this->CRLF.$this->CRLF);
            fputs($this->sock,base64_encode($this->content).$this->CRLF.$this->CRLF);
                         //attachment
            fputs($this->sock,'--'.$boundary.$this->CRLF);
            fputs($this->sock,'Content-type:'.$this->file_type.'; name==?UTF-8?B?'.base64_encode($this->file_name).'?='.$this->CRLF);
            fputs($this->sock,'Content-Transfer-Encoding:base64'.$this->CRLF);
            fputs($this->sock,'Content-Disposition: attachment; filename==?UTF-8?B?'.base64_encode($this->file_name).'?='.$this->CRLF.$this->CRLF);
            $file_string=chunk_split(base64_encode(file_get_contents($this->attachment)),76,$this->CRLF);
            fputs($this->sock,$file_string.$this->CRLF);
            fputs($this->sock,'--'.$boundary.$this->CRLF);
        }else{
                         //No attachments
            fputs($this->sock,'Content-Type:text/html; charset=UTF-8; format=flowed'.$this->CRLF);
            fputs($this->sock,'Content-Transfer-Encoding:base64'.$this->CRLF.$this->CRLF);
            fputs($this->sock,base64_encode($this->content).$this->CRLF.$this->CRLF);
        }
                 / / End symbol Wrap + tab +. + line feed + tabulation
        fputs($this->sock,'.'.$this->CRLF);
        $return=fread($this->sock,512);
        if(substr($return,0,3)!='250'){
                         //Send unsuccessful
                         Return ['status'=>false, 'msg'=> 'The text is not sent successfully'];
        }
        return ['status'=>true];
    }

    protected function mb_pathinfo($path, $options = null)
    {
        $ret = ['dirname' => '', 'basename' => '', 'extension' => '', 'filename' => ''];
        $pathinfo = [];
        if (preg_match('#^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$#im', $path, $pathinfo)) {
            if (array_key_exists(1, $pathinfo)) {
                $ret['dirname'] = $pathinfo[1];
            }
            if (array_key_exists(2, $pathinfo)) {
                $ret['basename'] = $pathinfo[2];
            }
            if (array_key_exists(5, $pathinfo)) {
                $ret['extension'] = $pathinfo[5];
            }
            if (array_key_exists(3, $pathinfo)) {
                $ret['filename'] = $pathinfo[3];
            }
        }
        switch ($options) {
            case PATHINFO_DIRNAME:
            case 'dirname':
                return $ret['dirname'];
            case PATHINFO_BASENAME:
            case 'basename':
                return $ret['basename'];
            case PATHINFO_EXTENSION:
            case 'extension':
                return $ret['extension'];
            case PATHINFO_FILENAME:
            case 'filename':
                return $ret['filename'];
            default:
                return $ret;
        }
    }

    /**
           * Judging mime type according to suffix
           * @param $ext suffix
     *
     * */
    protected function _mime_types($ext = '')
    {
        $mimes = [
            'xl' => 'application/excel',
            'js' => 'application/javascript',
            'hqx' => 'application/mac-binhex40',
            'cpt' => 'application/mac-compactpro',
            'bin' => 'application/macbinary',
            'doc' => 'application/msword',
            'word' => 'application/msword',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
            'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
            'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
            'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
            'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            'class' => 'application/octet-stream',
            'dll' => 'application/octet-stream',
            'dms' => 'application/octet-stream',
            'exe' => 'application/octet-stream',
            'lha' => 'application/octet-stream',
            'lzh' => 'application/octet-stream',
            'psd' => 'application/octet-stream',
            'sea' => 'application/octet-stream',
            'so' => 'application/octet-stream',
            'oda' => 'application/oda',
            'pdf' => 'application/pdf',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            'smi' => 'application/smil',
            'smil' => 'application/smil',
            'mif' => 'application/vnd.mif',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'wbxml' => 'application/vnd.wap.wbxml',
            'wmlc' => 'application/vnd.wap.wmlc',
            'dcr' => 'application/x-director',
            'dir' => 'application/x-director',
            'dxr' => 'application/x-director',
            'dvi' => 'application/x-dvi',
            'gtar' => 'application/x-gtar',
            'php3' => 'application/x-httpd-php',
            'php4' => 'application/x-httpd-php',
            'php' => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps' => 'application/x-httpd-php-source',
            'swf' => 'application/x-shockwave-flash',
            'sit' => 'application/x-stuffit',
            'tar' => 'application/x-tar',
            'tgz' => 'application/x-tar',
            'xht' => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'zip' => 'application/zip',
            'mid' => 'audio/midi',
            'midi' => 'audio/midi',
            'mp2' => 'audio/mpeg',
            'mp3' => 'audio/mpeg',
            'm4a' => 'audio/mp4',
            'mpga' => 'audio/mpeg',
            'aif' => 'audio/x-aiff',
            'aifc' => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff',
            'ram' => 'audio/x-pn-realaudio',
            'rm' => 'audio/x-pn-realaudio',
            'rpm' => 'audio/x-pn-realaudio-plugin',
            'ra' => 'audio/x-realaudio',
            'wav' => 'audio/x-wav',
            'mka' => 'audio/x-matroska',
            'bmp' => 'image/bmp',
            'gif' => 'image/gif',
            'jpeg' => 'image/jpeg',
            'jpe' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'webp' => 'image/webp',
            'heif' => 'image/heif',
            'heifs' => 'image/heif-sequence',
            'heic' => 'image/heic',
            'heics' => 'image/heic-sequence',
            'eml' => 'message/rfc822',
            'css' => 'text/css',
            'html' => 'text/html',
            'htm' => 'text/html',
            'shtml' => 'text/html',
            'log' => 'text/plain',
            'text' => 'text/plain',
            'txt' => 'text/plain',
            'rtx' => 'text/richtext',
            'rtf' => 'text/rtf',
            'vcf' => 'text/vcard',
            'vcard' => 'text/vcard',
            'ics' => 'text/calendar',
            'xml' => 'text/xml',
            'xsl' => 'text/xml',
            'wmv' => 'video/x-ms-wmv',
            'mpeg' => 'video/mpeg',
            'mpe' => 'video/mpeg',
            'mpg' => 'video/mpeg',
            'mp4' => 'video/mp4',
            'm4v' => 'video/mp4',
            'mov' => 'video/quicktime',
            'qt' => 'video/quicktime',
            'rv' => 'video/vnd.rn-realvideo',
            'avi' => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie',
            'webm' => 'video/webm',
            'mkv' => 'video/x-matroska',
        ];
        $ext = strtolower($ext);
        if (array_key_exists($ext, $mimes)) {
            return $mimes[$ext];
        }
        return 'application/octet-stream';
    }

    /**
           * Generate a random string for when there is an attachment. The message boundary distinguishes between multiple parts.
     *
     *
     * */
    protected function generateId()
    {
        $len = 32; //256 bits
        if(function_exists('random_bytes')){
            $bytes = random_bytes($len);
        }else if(function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes($len);
        }else{
            $bytes = hash('sha256', uniqid((string) mt_rand(), true), true);
        }
        return 'b1_'.str_replace(['=', '+', '/'], '', base64_encode(hash('sha256', $bytes, true)));
    }

    /**
           * Disconnect smtp server connection release handle
     *
     *
     * */
    protected function close(){
        if($this->sock!==null){
            if($this->connectSMTP){
                fputs($this->sock,'QUIT'.$this->CRLF);
                if(substr(fread($this->sock,512),0,3)!='221'){
                    //Send unsuccessful
                                         Return ['status'=>false, 'msg'=> 'Exit command failed to send'];
                }
            }
            if(is_resource($this->sock)){
                fclose($this->sock);
            }
        }
        return ['status'=>true];
    }

    /**
           * Destructor Disconnect
     *
     *
     */
    public function __destruct()
    {
        $this->close();
    }
}
?>
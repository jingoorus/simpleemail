<?php
final class SimpleEmail
{
    private $from = null;

    private $to = [];

    private $sender = null;

    private $reciever = null;

    private $subject = null;

    private $body = null;

    private $headers = [];

    private $html = true;

    private $newline = "\r\n";
    
    public function __construct(array $options = [])
    {
        $this->set($options);
    }

    public function set(array $options = []) : void
    {
        if ( count( $options ) > 0 ) {

            foreach ($options as $name => $value) {

                if ( property_exists( $this, $name ) ) {
    
                    if ( is_array( $this->$name ) ) {

                        $this->$name[] = $value;

                    } else {

                        $this->$name = $value;
                    }
                }
            }
        }
    }

    public function purge($name) : ?bool
    {
        if ( property_exists( $this, $name ) && $name != 'newline' ) {
    
            if ( is_array( $this->$name ) ) {

                $this->$name = [];

            } else {

                $this->$name = null;
            }

            return true;
        }

        return null;
    }

    public function send() : bool
    {
        if ( is_array( $this->to ) ) {

            foreach ($this->to as $n => $to) {

                if ( $to === '' ) {

                    unset($this->to[$n]);
                }
            }

			$to = implode(',', $this->to);

		} else {

			$to = $this->to;
		}

        $headers = '';

        if ( count( $this->headers ) ) {

            $headers = implode($this->newline, $this->headers);
        }

        $headers .= 'From: ' . '=?UTF-8?B?' . base64_encode($this->sender) . '?=' . '<' . $this->from . '>' . $this->newline;

		$headers .= 'Reply-To: ' . '=?UTF-8?B?' . base64_encode($this->sender) . '?=' . '<' . $this->from . '>' . $this->newline;

		$headers .= 'Return-Path: ' . $this->from . $this->newline;
        
        $headers .= 'Content-type: text/' . ($this->html === true ? 'html' : 'plain') . '; charset=utf-8' . $this->newline;
        
        $headers .= 'Mime-Version: 1.0' . $this->newline;
        
        return mail($to, $this->subject, $this->body, $headers);
    }
}
?>

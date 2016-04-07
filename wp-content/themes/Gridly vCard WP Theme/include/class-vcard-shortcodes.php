<?php


if (!class_exists('Neuethemes_vCardShortCodeBase'))
{
    abstract class Neuethemes_vCardShortCodeBase
    {
        public $name;

        protected function __construct ($name)
        {
            $this->name = $name;
        }

        public abstract function execute($attributes, $content = null);
    }

    class Neuethemes_LabelShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('label');
        }

        public function execute ($attributes, $content = null)
        {
            $attributes = array_merge( array('color' => ''), $attributes);

            $color = $attributes['color'];
            return "<p class='$color'>$content</p>";
        }
    }

    class Neuethemes_ButtonShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('button');
        }

        public function execute ($attributes, $content = null)
        {
            $color = $attributes['color'];
            $action = $attributes['url'];
            return "<input type='button' class='button-$color' onclick='window.location=\'$action\'  value='$content'/>";
        }
    }

    class Neuethemes_AlertShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('alert');
        }

        public function execute ($attributes, $content = null)
        {
            $attributes = array_merge( array('type' => ''), $attributes);

            $type = $attributes['type'];
            return "<p class='alert $type'>$content</p>";
        }
    }

    class Neuethemes_ContactShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('contact');
        }

        public function execute ($attributes, $content = null)
        {
            $attributes = array_merge( array('type' => ''), $attributes);


            switch($attributes['type'])
            {
                case 'phone':
                    $body = of_get_option('vcard_contact_phone');
                    $icon = 'fa-phone-square';
                    break;

                case 'skype':
                    $id = of_get_option('vcard_skype');

                    $link = "callto:" . $id;
                    if (!isset($content))
                        $body = $id;

                    $icon = 'fa-skype';
                    break;

                case 'facebook':
                    $link = of_get_option('vcard_facebook');
                    if (!isset($content))
                        $body = $this->getAccount($link);
                    $icon = 'fa-facebook';
                    break;

                case 'twitter':
                    $link = of_get_option('vcard_twitter');
                    if (!isset($content))
                        $body = $this->getAccount($link);
                    $icon = 'fa-twitter';
                    break;

                case 'linked-in':
                    $link = of_get_option('vcard_linked_in');
                    if (!isset($content))
                        $body = $this->getAccount($link);
                    $icon = 'fa-linkedin-square';
                    break;

                case 'instagram':
                    $link = of_get_option('vcard_instagram');
                    if (!isset($content))
                        $body = $this->getAccount($link);
                    $icon = 'fa-instagram';
                    break;

                case 'email':
                    $link = "mailto:" . of_get_option('vcard_feedback_email');
                    if (!isset($content))
                        $body = $this->getAccount($link);
                    $icon = 'fa-envelope';
                    break;

                default:
                    $body = $content;
                    $icon = 'fa-info';
                    break;
            }

            if (isset($link))
                $body = "<a href='$link'>$body</a>";

            return "<span><i class='fa $icon'></i>&nbsp;$body</span>";
        }

        private function getAccount($link)
        {
            return basename($link);
        }
    }

    class Neuethemes_EmploymentShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('employment');
        }

        public function execute ($attributes, $content = null)
        {
            return '</div><div class="grey-content">
                    <div><h2>Empleo</h2></div>
                    '.do_shortcode($content).'
                </div>';
        }
    }

    class Neuethemes_EducationShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('education');
        }

        public function execute ($attributes, $content = null)
        {
            return '<div class="plain-content"><div><h2>Educación</h2></div>'.do_shortcode($content).'</div><div class="clear dividewhite3"></div>';
        }
    }

    abstract class Neuethemes_TwoColumnShortCodeBaseNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        protected function __construct($name)
        {
            parent::__construct($name);
        }

        protected function split($content)
        {
            $len = strlen($content);
            $middle = intval($len/2);
            while(($middle < $len) AND (!$this->isWhiteSpace($content[$middle])))
                $middle++;

            return '<div class="one-half">'.substr($content,0,$middle).'</div>
            <div class="one-half column-last">'.substr($content,$middle).'</div>';
        }

        private function isWhiteSpace($char)
        {
            return $char === " ";
        }
    }


    class Neuethemes_JobShortCode extends Neuethemes_TwoColumnShortCodeBaseNeuethemes
    {
        function __construct ()
        {
            parent::__construct('job');
        }

        public function execute ($attributes, $content = null)
        {
            $attributes = array_merge(
                array('from' => '', 'till' => '', 'organisation' => '', 'position' => ''),
                $attributes
            );

            return '<div class="job">
                    <div class="date">
                        <div class="datefrom">'.$attributes['from'].'</div>
                        <div class="datetill">'.$attributes['till'].'</div>
                        <div class="trianglewrap"><div class="datetriangle"></div></div>
                    </div>
                    <div class="jobtitle">
                      <h3>'.$attributes['organisation'].'</h3>
                      <h4><strong>'.$attributes['position'].'</strong></h4>
                      <div class="jobdescription">'.$this->split($content).'</div>
                    </div>
                </div>
                <div class="clear dividewhite3"></div>';
        }
    }

    class Neuethemes_SchoolShortCode extends Neuethemes_TwoColumnShortCodeBaseNeuethemes
    {
        function __construct ()
        {
            parent::__construct('school');
        }

        public function execute ($attributes, $content = null)
        {
            $attributes = array_merge(
                array('from' => '', 'till' => '', 'name' => '', 'major' => ''),
                $attributes
            );

            return '<div class="job">
                    <div class="date">
                      <div class="datefrom">'.$attributes['from'].'</div>
                      <div class="datetill-f">'.$attributes['till'].'</div>
                      <div class="trianglewrap"><div class="datetriangle-f"></div></div>
                    </div>
                    <div class="jobtitle">
                      <h3>'.$attributes['name'].'</h3>
                      <h4><strong>'.$attributes['major'].'</strong></h4>
                      <div class="jobdescription">'.$this->split($content).'</div>
                    </div>
                    <div class="clear dividewhite3"></div>
                </div>';
        }
    }

    class Neuethemes_SkillsShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('skills');
        }

        public function execute ($attributes, $content = null)
        {
            return '<div class="grey-content">
                  <div><h2>Habilidades</h2></div>
                  <div class="clear dividewhite3"></div>
                  <div>'.do_shortcode($content).'</div>
                  <div class="clear dividewhite3"></div>
                </div>';
        }
    }

    class Neuethemes_SkillShortCodeNeuethemes extends Neuethemes_vCardShortCodeBase
    {
        public function __construct()
        {
            parent::__construct('skill');
        }

        public function execute ($attributes, $content = null)
        {
            $attributes = array_merge(array('color' => 'fff', 'percent_of_knowledge' => 0, 'title' => ''), $attributes);
            return '<div class="one-third '.self::adjustColumnLast().'">
                      <div>
                        <input class="knob" data-width="150" data-fgColor="#'.$attributes['color'].'" data-bgColor="#d2d4d8" data-thickness=".2" readonly value="'.$attributes['percent_of_knowledge'].'">
                        <h4><strong>'.$attributes['title'].'</strong></h4>
                        '.$content.'
                      </div>
                    </div>';
        }

        static $columnsPassed=0;

        private static function adjustColumnLast ()
        {
            self::$columnsPassed++;
            return (self::$columnsPassed%3 == 0) ? 'column-last' : '';
        }
    }
}

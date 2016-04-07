<?php
/**
 * Created by PhpStorm.
 * User: nvsnkv
 * Date: 03.03.14
 * Time: 21:13
 */

class Neuethemes_vCardQuickContact
{
    private $type;
    private $uri;

    function __construct ($type, $uri = false)
    {
        $this->type = $type;
        $this->uri = of_get_option('vcard_'.$type);
        if (!empty($uri))
            $this->uri = $uri;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return !empty($this->uri);
    }


    public function __toString()
    {
        switch($this->type)
        {
            case "main": return '<a title="Index" href="'.$this->uri.'"><div class="blog"><i class="fa fa-suitcase"></i></div></a>';
            case "blog": return '<a title="Blog" href="'.$this->uri.'"><div class="blog"><i class="fa fa-wordpress"></i></div></a>';
            case "facebook": return '<a title="Facebook" href="'.$this->uri.'"><div class="facebook"><i class="fa fa-facebook"></i></div></a>';
            case "twitter": return '<a title="Twitter" href="'.$this->uri.'"><div class="twitter"><i class="fa fa-twitter"></i></div></a>';
            case "linked_in": return '<a title="LinkedIn" href="'.$this->uri.'"><div class="linkedin"><i class="fa fa-linkedin"></i></div></a>';
            case "skype": return '<a title="Skype" href="callto:'.$this->uri.'?call"><div class="skype"><i class="fa fa-skype"></i></div></a>';
            case "instagram": return '<a title="Instagram" href="'.$this->uri.'"><div class="instagram"><i class="fa fa-instagram"></i></div></a>';
        }

        throw new InvalidArgumentException("Unknown contact type given!");
    }
}

class Neuethemes_vCardQuickContacts
{
    private $_contacts;

    function __construct ()
    {
        $this->_contacts = array();

        $this->_contacts[] = new Neuethemes_vCardQuickContact('blog', $this->getBlogUrl());
        $this->_contacts[] = new Neuethemes_vCardQuickContact('facebook');
        $this->_contacts[] = new Neuethemes_vCardQuickContact('twitter');
        $this->_contacts[] = new Neuethemes_vCardQuickContact('linked_in');
        $this->_contacts[] = new Neuethemes_vCardQuickContact('skype');
        $this->_contacts[] = new Neuethemes_vCardQuickContact('instagram');
    }


    public function __toString ()
    {
        $result = '<div class="social-buttons">' . PHP_EOL;
        foreach ($this->_contacts as $contact)
        {
            if ($contact->isVisible())
                $result .= $contact . PHP_EOL;
        }

        $result .= '</div>' .PHP_EOL;

        return $result;
    }

    private function getBlogUrl()
    {
        $page_for_posts = get_option('page_for_posts');
        return get_permalink($page_for_posts);
    }
} 

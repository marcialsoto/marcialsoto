<?php
if (!class_exists('Neuethemes_vCardPage'))
{
    abstract class Neuethemes_vCardPage
    {
        public function __get($name)
        {
            switch($name)
            {
                case "name": return $this->getName();
                case "title": return $this->getTitle();
                case "defaultContent": return $this->getDefaultContent();
                default:
                    throw new InvalidArgumentException("Page has no property $name");
            }
        }

        public function exists()
        {
            $page = get_page_by_title($this->title);
            return !empty($page);
        }

        protected abstract function getName ();
        protected abstract function getTitle ();
        protected abstract function showDefaultContent();

        private function getDefaultContent ()
        {
            ob_start();
            $this->showDefaultContent();
            $content = ob_get_contents();
            ob_end_clean();

            return $content;
        }
    }
}

if (!class_exists('Neuethemes_VCardBlogPage'))
{
    class Neuethemes_VCardBlogPage extends Neuethemes_vCardPage
    {
        //PHP! WHY YOU NO ABSTRACT PROPERTIES???
        protected function getName () {return 'blog'; }

        protected function getTitle () {return 'Blog Index Stub'; }

        protected function showDefaultContent ()
        {
            echo "";
        }
    }
}

if (!class_exists('Neuethemes_VCardFrontPage'))
{
    class Neuethemes_VCardFrontPage extends Neuethemes_vCardPage
    {
        protected function getName () {return 'front_page'; }

        protected function getTitle () {return 'Front Page Stub'; }

        protected function showDefaultContent ()
        {
            echo "";
        }
    }
}

if (!class_exists('Neuethemes_VCardHomePage'))
{
    class Neuethemes_VCardHomePage extends Neuethemes_vCardPage
    {
        protected function getName () { return 'vcard_home_page_part'; }

        protected function getTitle () {return 'vCard :: Home'; }

        protected function showDefaultContent ()
        {
            ?>
            [label color="orange"]Gridly Personal vCard & Portfolio [/label]
            [label color="blue"]WordPress Theme[/label]
            <p class="home-description">Minimalistic fully resposive WordPress theme for portfolio. Simple navigation, social integration, high resolution graphics supported. Quick WordPress installation. No extra coding.</p> 
            [contact type="phone"/]
        <?php
        }
    }

}

if (!class_exists('Neuethemes_VCardAboutPage'))
{
    class Neuethemes_VCardAboutPage extends Neuethemes_vCardPage
    {
        protected function getName () { return 'vcard_about_page_part'; }

        protected function getTitle () {return 'vCard :: About'; }

        protected function showDefaultContent ()
        {
            ?>
            <h1>Welcome!</h1>
            <p>Gridly is fully resposive vCard and portfolio WordPress theme based on simple one-page WordPress template with tabbed navigation. Ideal for personal purposes.</p>
            <p>You can modify this text in Pages &gt; vCard :: About page.</p>
            <p>You can manage services below simply adding / removing posts in "Services" category.</p>
        
        <?php
        }

        public static function adjustColumnLast ($processedServices)
        {
            return ($processedServices%3 == 2) ? "column-last" : "";
        }
    }

}

if (!class_exists('Neuethemes_VCardContactsPage'))
{
    class Neuethemes_VCardContactsPage extends Neuethemes_vCardPage
    {
        protected function getName () { return 'vcard_contacts_page_part'; }

        protected function getTitle () {return 'vCard :: Contacts'; }

        protected function showDefaultContent ()
        {
            ?>
            <h1>Contacts</h1>
            <p>You can modify this text in Pages &gt; vCard :: Contacts page.</p>

            <p>
            1234 Oxford drive, Daytona Beach, FL 90266, USA<br />
            Phone: (415) 124-5678 Fax: (415) 124-5678<br />
            info@snobcompany.com<br />
            </p>

            To customize your location on the map please add latitude and longitude at "Map" section on a "vCard" admin page.
        <?php
        }
    }
}

if (!class_exists('Neuethemes_VCardFeedbackPage'))
{
    class Neuethemes_VCardFeedbackPage extends Neuethemes_vCardPage
    {
        protected function getName () { return 'vcard_feedback_page_part'; }

        protected function getTitle () {return 'vCard :: Feedback'; }

        protected function showDefaultContent ()
        {
            ?>
            <h1>Feedback</h1>
            <p>This feedback form can be used to send me an email.</p>
            <p>You can modify this text in Pages &gt; vCard :: Feedback page.</p>
        <?php
        }
    }
}

if (!class_exists('Neuethemes_VCardPortfolioPage'))
{
    class Neuethemes_VCardPortfolioPage extends Neuethemes_vCardPage
    {
        protected function getName () { return 'vcard_portfolio_page_part'; }

        protected function getTitle () {return 'vCard :: Portfolio'; }

        protected function showDefaultContent ()
        {
            ?>
            <h1>Portfolio</h1>
            <p>Here i'd like to describe all my professional experience and skills.</p>

            <p>You can modify this text in Pages &gt; vCard :: Portfolio page.</p>
        <?php
        }
    }
}

if (!class_exists('Neuethemes_VCardResumePage'))
{
    class Neuethemes_VCardResumePage extends Neuethemes_vCardPage
    {
        protected function getName () { return 'vcard_resume_page_part'; }

        protected function getTitle () {return 'vCard :: Resume'; }

        protected function showDefaultContent ()
        {
            ?>
            <h1>Resume</h1>
            <p>Gridly Portfolio WordPress Theme is optimized for desktop & mobile. Clean WP code & modern flat design.</p>
            You can modify this text in Pages &gt; vCard :: Resume page.

            [employment]
            [job from="2011" till="present" organisation="Connectivity Group LLC" position="Art director"]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida
            [/job]
            [/employment]

            [education]
            [school from="2011" till="present" name="Connectivity Group LLC" major="Art director"]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida
            [/school]
            [/education]

            [skills]
            [skill name="Lorem" percent_of_knowledge="19" color="1abc9c"]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida
            [/skill]
            [skill name="ipsum" percent_of_knowledge="99" color="9b59b6"]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida
            [/skill]
            [skill name="dolor" percent_of_knowledge="56" color="e74c3c"]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla libero a nibh sollicitudin, ac pharetra diam convallis. Integer lobortis justo tempus odio gravida
            [/skill]
            [/skills]
        <?php
        }
    }
}

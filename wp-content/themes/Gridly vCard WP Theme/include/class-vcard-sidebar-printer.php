<?php

if (!class_exists('Neuethemes_vCardSidebarPrinter'))
{
    class Neuethemes_vCardSidebarPrinter
    {
        public static function display($index)
        {
            global $wp_registered_sidebars, $wp_registered_widgets;

            $index = self::sanitizeIndex($index, $wp_registered_sidebars);

            $sidebars_widgets = wp_get_sidebars_widgets();
            if ( empty( $wp_registered_sidebars[ $index ] ) || empty( $sidebars_widgets[ $index ] ) || ! is_array( $sidebars_widgets[ $index ] ) ) {
                return false;
            }

            $sidebar = $wp_registered_sidebars[$index];

            $widgets = array();
            foreach ( (array) $sidebars_widgets[$index] as $id ) {
                if ( !isset($wp_registered_widgets[$id]) ) continue;
                $widgets[] = $id;
            }

            $count = count($widgets);
            self::$processedCount = 0;
            $did_one = false;
            foreach ( $widgets as $id ) {

                $params = array_merge(
                    array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
                    (array) $wp_registered_widgets[$id]['params']
                );

                // Substitute HTML id and class attributes into before_widget
                $classname_ = '';
                foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
                    if ( is_string($cn) )
                        $classname_ .= '_' . $cn;
                    elseif ( is_object($cn) )
                        $classname_ .= '_' . get_class($cn);
                }
                $classname_ = ltrim($classname_, '_');
                $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);

                $params = apply_filters( 'dynamic_sidebar_params', $params );

                $callback = $wp_registered_widgets[$id]['callback'];

                do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

                if ( is_callable($callback) ) {
                    self::printBeforeWidget($count);
                    call_user_func_array($callback, $params);
                    $did_one = true;
                    self::printAfterWidget();
                }

                $count--;
            }

            return $did_one;
        }

        private static function sanitizeIndex ($index, $wp_registered_sidebars)
        {
            if (is_int($index)) {
                $index = "sidebar-$index";

                return $index;
            } else {
                $index = sanitize_title($index);
                foreach ((array)$wp_registered_sidebars as $key => $value) {
                    if (sanitize_title($value['name']) == $index) {
                        $index = $key;
                        break;
                    }
                }

                return $index;
            }
        }

        private static $processedCount;

        private static function adjsutClass($remains)
        {
            $class =  "column-last";

            $args = "remains: $remains | processed: ".self::$processedCount;
            echo "<script type='text/javascript'> console.log('$args') </script>";


            if ((self::$processedCount + $remains) >= 3)
            {
                $class = "one-third";
                if (self::$processedCount == 2)
                    $class .= " column-last";
            }
            else if ((self::$processedCount + $remains) == 2)
            {
                $class = "one-half";
                if (self::$processedCount == 1)
                    $class .= " column-last";
            }

            self::$processedCount++;
            self::$processedCount %= 3;

            $args = "$class";
            echo "<script type='text/javascript'> console.log('$args') </script>";


            return $class;
        }

        private static function printBeforeWidget($count)
        {
            $class = self::adjsutClass($count);
            echo "<div class='vcard-widget $class'>";
        }

        private static function printAfterWidget()
        {
            echo "</div>";
        }
    }
}

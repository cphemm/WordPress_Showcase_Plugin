<?php
class Showcase_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
            'showcase_widget', // Base ID
            __('Showcase Widget', 's_text_domain'), // Name
            array('description' => __('A widget to display showcase content', 'text_domain'),) // Args
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget
        $s_title = apply_filters('widget_title', $instance['title']);
        $s_heading = $instance['heading'];
        $s_text = $instance['text'];

        echo $args['before_widget'];
        if (!empty($s_title))
            echo $args['before_title'] . $s_title . $args['after_title'];
        // Display Content
        echo $this->getContent($s_heading, $s_text);
        echo $args['after_widget'];
    }

    public function getContent($s_heading, $s_text) {
        $output = '
    <h1>'.$s_heading.'</h1>
    <p>'.$s_text.'</p>
        <button class="button">Start Shopping</button>';

        // Return Output String
        return $output;
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        if(isset($instance['title'])) {
            $s_title = $instance['title'];
        }
        else {
            $s_title = __('Showcase Widget', 's_text_domain');
        }
        $s_heading = $instance['heading'];
        $s_text = $instance['text'];
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text" value="
                        <?php echo esc_attr($s_title); ?>">
            </p>
        <p>
            <label for="<?php echo $this->get_field_id('heading'); ?>"><?php _e('Heading:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('heading'); ?>"
                   name="<?php echo $this->get_field_name('heading'); ?>" type="text" value="
                        <?php echo esc_attr($s_heading); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>"
                   name="<?php echo $this->get_field_name('text'); ?>" type="text" value="
                        <?php echo esc_attr($s_text); ?>">
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['heading'] = (!empty($new_instance['heading'])) ? strip_tags($new_instance['heading']) : '';
        $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']) : '';

        return $instance;
    }
}

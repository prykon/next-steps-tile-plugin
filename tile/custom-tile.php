<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Next_Steps_Tile_Tile
{
    private static $_instance = null;
    public static function instance(){
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct(){
        add_filter( 'dt_details_additional_tiles', [ $this, "dt_details_additional_tiles" ], 10, 2 );
        add_filter( "dt_custom_fields_settings", [ $this, "dt_custom_fields" ], 1, 2 );
        add_action( "dt_details_additional_section", [ $this, "dt_add_section" ], 30, 2 );
    }

    /**
     * This function registers a new tile to a specific post type
     *
     * @todo Set the post-type to the target post-type (i.e. contacts, groups, trainings, etc.)
     * @todo Change the tile key and tile label
     *
     * @param $tiles
     * @param string $post_type
     * @return mixed
     */
    public function dt_details_additional_tiles( $tiles, $post_type = "" ) {
        if ( $post_type === "contacts" ){
            $tiles["Next_Steps_Tile"] = [ "label" => __( "Next Steps Tile", 'disciple_tools' ) ];
        }
        return $tiles;
    }

    /**
     * @param array $fields
     * @param string $post_type
     * @return array
     */
    public function dt_custom_fields( array $fields, string $post_type = "" ) {
        /**
         * @todo set the post type
         */
        if ( $post_type === "contacts" ){
            /**
             * @todo Add the fields that you want to include in your tile.
             *
             * Examples for creating the $fields array
             * Contacts
             * @link https://github.com/DiscipleTools/disciple-tools-theme/blob/256c9d8510998e77694a824accb75522c9b6ed06/dt-contacts/base-setup.php#L108
             *
             * Groups
             * @link https://github.com/DiscipleTools/disciple-tools-theme/blob/256c9d8510998e77694a824accb75522c9b6ed06/dt-groups/base-setup.php#L83
             */

            /**
             * Requests field
             */
            $fields["Requests_multiselect"] = [
                "name" => __( 'Requests', 'disciple_tools' ),
                "default" => [
                    "prayer" => [ "label" => __( "Prayer", 'disciple_tools' ) ],
                    "bible" => [ "label" => __( "Bible", 'disciple_tools' ) ],
                    "online_connection" => [ "label" => __( "Online Connection", 'disciple_tools' ) ],
                    "face-to-face" => [ "label" => __( "Face to Face", 'disciple_tools' ) ],
                ],
                "tile" => "Next_Steps_Tile",
                "type" => "multi_select",
                "hidden" => false,
                'icon' => get_template_directory_uri() . '/dt-assets/images/can-share.svg',
            ];

            /**
             * Contact Preference field
             */
            $fields["Contact_Preference_multiselect"] = [
                "name" => __( 'Contact Preference', 'disciple_tools' ),
                "default" => [
                    "messenger" => [ "label" => __( "Messenger", 'disciple_tools' ) ],
                    "whatsapp" => [ "label" => __( "WhatsApp", 'disciple_tools' ) ],
                    "viber" => [ "label" => __( "Viber", 'disciple_tools' ) ],
                    "mobile_text" => [ "label" => __( "Mobile Text", 'disciple_tools' ) ],
                    "zoom" => [ "label" => __( "Zoom", 'disciple_tools' ) ],
                    "phone_call" => [ "label" => __( "Phone Call", 'disciple_tools' ) ],
                ],
                "tile" => "Next_Steps_Tile",
                "type" => "multi_select",
                "hidden" => false,
                'icon' => get_template_directory_uri() . '/dt-assets/images/phone.svg',
            ];

            /**
             * Translation field
             */
            $fields["Translation_multiselect"] = [
                "name" => __( 'Translation', 'disciple_tools' ),
                "default" => [
                    "bosnian" => [ "label" => __( "Bosnian", 'disciple_tools' ) ],
                    "serbian" => [ "label" => __( "Serbian", 'disciple_tools' ) ],
                    "croatian" => [ "label" => __( "Croatian", 'disciple_tools' ) ],
                ],
                "tile" => "Next_Steps_Tile",
                "type" => "multi_select",
                "hidden" => false,
                'icon' => get_template_directory_uri() . '/dt-assets/images/speak.svg',
            ];

            /**
             * Mailing Status field
             */
            $fields["Mailing_Status_multiselect"] = [
                "name" => __( 'Mailing Status', 'disciple_tools' ),
                "default" => [
                    "requested" => [ "label" => __( "Requested", 'disciple_tools' ) ],
                    "sent" => [ "label" => __( "Sent", 'disciple_tools' ) ],
                    "received" => [ "label" => __( "Received", 'disciple_tools' ) ],
                    "hand_delivered" => [ "label" => __( "Hand Delivered", 'disciple_tools' ) ],
                ],
                "tile" => "Next_Steps_Tile",
                "type" => "multi_select",
                "hidden" => false,
                'icon' => get_template_directory_uri() . '/dt-assets/images/email.svg',
            ];
        }
        return $fields;
    }

    public function dt_add_section( $section, $post_type ) {
        /**
         * @todo set the post type and the section key that you created in the dt_details_additional_tiles() function
         */
        if ( $post_type === "contacts" && $section === "Next_Steps_Tile" ){
            /**
             * These are two sets of key data:
             * $this_post is the details for this specific post
             * $post_type_fields is the list of the default fields for the post type
             *
             * You can pull any query data into this section and display it.
             */
            $this_post = DT_Posts::get_post( $post_type, get_the_ID() );
            $post_type_fields = DT_Posts::get_post_field_settings( $post_type );
        }
    }
}
Next_Steps_Tile_Tile::instance();

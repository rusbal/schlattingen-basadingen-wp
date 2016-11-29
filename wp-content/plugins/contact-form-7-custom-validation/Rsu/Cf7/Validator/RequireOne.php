<?php

namespace Rsu\Cf7\Validator;


class RequireOne
{
    protected $list;

    public function __construct($list)
    {
        $this->list = $list;

        add_filter( 'wpcf7_validate_checkbox', [$this, 'wpcf7_checkbox_validation_filter_conditional'], 10, 2 );
    }

    function wpcf7_checkbox_validation_filter_conditional($result, $tag) {
        $validatePrefix = null;

        $tag = new \WPCF7_Shortcode( $tag );

        $type = $tag->type;
        $name = $tag->name;

        foreach (array_keys($this->list) as $postPrefix) {
            if (strpos($name, $postPrefix) === 0) {
                $validatePrefix = $postPrefix;
                break;
            }
        }

        if ($validatePrefix) {
            $pos = array_search($name, $this->list[$validatePrefix]);
            if ($pos !== false) {
                $pos += 1;
                $count = count($this->list[$validatePrefix]);
                $isLast = $pos == $count;
                $isSecondToLast = $pos == ($count - 1);
                $isEven = $count % 2 == 0;
                $setAsRequired = (($isEven && $isSecondToLast) || (! $isEven && $isLast));

                if ($setAsRequired) {
                    $checked = array_reduce($this->list[$validatePrefix], function($carry, $fieldMember) {
                        return $carry || isset($_POST[$fieldMember]);
                    });

                    if ( !$checked ) {
                        $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
                    }
                }
            }
        }

        return $result;
    }
}
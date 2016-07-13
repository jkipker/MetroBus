<?php

if(!function_exists('conall_edge_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function conall_edge_is_responsive_on() {
        return conall_edge_options()->getOptionValue('responsiveness') !== 'no';
    }
}
<?php

namespace App\Data;

use App\Models\Producto;

class Chart {
    
    private $chart = [];
    
    function add( Producto $producto ) {
        
        if( isset( $this->chart[$producto->nombre][0] ) ) {
            $this->chart[$producto->nombre][1] = $this->chart[$producto->nombre][1] + 1;
        } else {
            $this->chart[$producto->nombre][0] = $producto;
            $this->chart[$producto->nombre][1] = 1;
        }
        
        return $this->chart[$producto->nombre][1];
    }
    
    function empty( Producto $producto ) {
        
        if( isset( $this->chart[$producto->nombre][0] ) ) {
            unset( $this->chart[$producto->nombre] );
            return true;
        }
        return false;
        
    }
    
    function emptyChart() {
        unset( $this->chart );
        $this->chart = [];
    }
    
    function get() {
        return $this->chart;
    }
    
    function substract( Producto $producto ) {
        if( isset( $this->chart[$producto->nombre][0] ) ) {
            $this->chart[$producto->nombre][1] = $this->chart[$producto->nombre][1] - 1;
            if( $this->chart[$producto->nombre][1] < 1 ) {
                $this->empty( $producto );
                return 0;
            }
            return $this->chart[$producto->nombre][1];
        }
        return false;
    }
    
}

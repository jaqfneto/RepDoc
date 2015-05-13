<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stack
 *
 * @author jfn
 */
class Stack {
    //put your code here
    private $stk = array();
    private $n=0;
 
	public function __construct() {
	}
 
	public function push($data) {
		array_push($this->stk, $data);
                $this->n++;
	}
 
	public function pop() {
		return array_pop($this->stk);
                  $this->n--;
	}
        public function getStack(){
            return $this->stk;
        }
        public function isEmpty(){
           
            if ($this->n==0) return true;
            else return false;
        } 
        
        public function pop_FIFO() {   
            $this->n--;
            return array_shift($this->stk);         
	}
 
}

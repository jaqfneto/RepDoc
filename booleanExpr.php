<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'Stack.php';
//include 'dbFunc.php';
/*
$bool_expr ="iahs AND relatório OR dwp";
$bool_expr_arr = explode(" ",$bool_expr);
$calc_stack =new Stack();
$result_select =array(
      "A"=>array("1","2","3","6"),
      "B"=>array("3","5","6"),
      "C"=>array("1","4","6","9"),
      "D"=>array("1","2","8","5"),
      "E"=>array("1","2","7"),
      "F"=>array("2","3","5","10")
        
    
    );
 * */
 
//print "final";
//print_r(solveBooleanExpression($bool_expr, $result_select));
//print_r(getArrayOfTermsWithFilesId ($bool_expr));




function getArrayOfTermsWithFilesId ($bool_expr, $type){
    /* recebe palavra ou expressão a pesquisar
     * e
     * devolve expressão correta
     * e array de arrays cada qual com a lista de docs que contêm os termos procurados:
     * Exemplo
     * 
     * engenharia civil
     * devolve
     * engenharia OR civil
     * e
     * todos os ids de ficheiros que contêm engenharia e civil
     * 
     */
    $result_select=array();
    $last_is_oper=true;
    $correct_expression=array();
    $bool_expr = preg_replace('!\s+!', ' ', $bool_expr);
    $bool_expr_arr = explode(" ",$bool_expr);
    //print "getArray";
    //print_r ($bool_expr_arr);
    foreach ($bool_expr_arr as $term){
        $term=trim($term);
        if (!is_operator($term)) {
            if ($type=="docs")
               $ids=searchInDocs($term);
            else
               $ids=searchInMissoes($term); 
            if ($ids!="")
                $result_select[$term] =explode(",",$ids);
            else {
                $result_select[$term]=array();
            }
            if ($last_is_oper){
              array_push($correct_expression, $term);
              $last_is_oper=false;
            }
            else {
            array_push($correct_expression, "OR");
            array_push($correct_expression, $term);
            $last_is_oper=false;
           }
       }else{
         array_push($correct_expression, $term);
         $last_is_oper=true;
       }
    }  
  //print_r ($result_select);
  $result=array("exp" =>$correct_expression, "res" =>$result_select );
  return $result;
}

function solveBooleanExpression($bool_expr_and_result_select){

$bool_expr_arr = $bool_expr_and_result_select["exp"];
//print_r($bool_expr_arr);
$result_select=$bool_expr_and_result_select["res"];
$calc_stack =new Stack();
$tmp_results =array();
$n_terms=count($bool_expr_arr);
if ($n_terms <=1) {
    
    return $result_select[$bool_expr_arr[0]];
}
foreach ($bool_expr_arr as $term){
    //print "termo". $n_terms ."----".$term."<br>";
    $n_terms--;
    if (is_operator($term)) {
        $calc_stack->push($term);
    } elseif ($term[0]=="(") {
        //$calc_stack->push("(");
         $calc_stack->push(ltrim($term,'('));
    } elseif (($term[strlen ($term)-1]==")") || $n_terms==0){
        
        $calc_stack->push(rtrim($term,')'));
        $op1=null;
        $op2=null;
        //print_r("expression: ".$calc_stack->getStack()."<br>");
        $n_term="(";
        while ((!$calc_stack->isEmpty())){
         // print "termo in stack"."----".$n_term."<br>";
          $n_term=$calc_stack->pop_FIFO();
          if (is_operator($n_term)) {
              $bool_operator=$n_term;
          }
          elseif ($op1==null) 
              if ($n_term =="TR") {$op1=  array_shift ($tmp_results);}
              else {$op1=$result_select[$n_term];}
          else {
             // print "conta <br>";
              $op2= $result_select[$n_term];   
              $tmp_result=solveExpression($op1,  strtoupper($bool_operator),$op2);
              //print_r ($tmp_result);
              $op1=$tmp_result;
              $op2=null;
          }      
        }
        //if (!$calc_stack->isEmpty())$dummy=$calc_stack->pop_FIFO ();
        if ($n_terms>0) {
            
            $calc_stack->push("TR");
            array_push($tmp_results, $tmp_result);
        }else{
           // print "result:";
           // print_r ($tmp_result); 
            return $tmp_result;
        }
    } else {
       $calc_stack->push($term);
    }
}

return $tmp_result;
}



function is_operator($term){
    $term = strtoupper($term);
    if ($term == "AND" || $term =="OR" || $term=="NOT") return true;
    else return false;
}

function solveExpression($op1,$bool_operator,$op2){
    $result=Array();
    switch ($bool_operator){
        case "AND":
            $result=  array_merge($op1, $op2);
            $result= array_unique(array_diff_assoc($result, array_unique($result)));
            break;
        case "OR":
            $result=  array_merge($op1, $op2);
            $result= array_unique($result);
            break;
        case "NOT": 
              $result = array_diff($op1, $op2);
            break;
        
    }
  //  print_r ($result);
 return $result;  
    
}

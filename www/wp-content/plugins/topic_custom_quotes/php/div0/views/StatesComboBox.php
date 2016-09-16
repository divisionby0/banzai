<?php

class StatesComboBox {
    public function show($states, $selectedState, $name){

        $statesIterator = $states->getIterator();

        $elementPrefix = '<select name="'.$name.'">';

        $elementContent = '';

        while($statesIterator->hasNext()){
            $quoteState = $statesIterator->next();
            $stateKey = $statesIterator->getCurrentIndex();

            $isSelectedValue = $selectedState==$stateKey;

            if($isSelectedValue){
                $elementContent.='<option selected="selected" value="'.$stateKey.'">'.$quoteState.'</option>';
            }
            else{
                $elementContent.='<option value="'.$stateKey.'">'.$quoteState.'</option>';
            }
        }

        $elementPostfix = '</select>';

        return $elementPrefix.$elementContent.$elementPostfix;
    }
} 
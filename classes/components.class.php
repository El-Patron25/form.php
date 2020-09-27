<?php

class Components {

	private $element;
	private $value;
	private $btn;

public function textValue($classname, $msg){
	$this->value = "<h6 class='$classname'><b>$msg</b></h6>";
	echo $this->value;
}

public function inputElement($label, $icon, $type, $name, $id){
	$this->element = '<div class="container">
				<label>'.$label.'</label>
				<label class="error"></label>
				'.$icon.'<input type="'.$type.'" name="'.$name.'" id="'.$id.'">
			</div>';
			echo $this->element;
}

public function buttonElement($btnid, $name, $icon, $text){
	$this->btn = 
	"<button name='".$name."'' id='".$btnid."'>".$text.$icon."</button>";
	echo $this->btn;
}

}

?>
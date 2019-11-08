<?php

class ErrorView extends View {

	
	public function render() {
		$this->loadTemplate($this->templateNames['head'], $this->args);
		$this->loadTemplate($this->templateNames['top'], $this->args);

		echo "<div class='content'>";
		$this->loadTemplate($this->templateNames['content'], $this->args);
		echo "</div>";

		$this->loadTemplate($this->templateNames['foot'], $this->args);
	}
}
?>
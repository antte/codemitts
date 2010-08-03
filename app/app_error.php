<?php
	class AppError extends ErrorHandler {
		
		function internal() {
			$this->_outputMessage('internal');
		}
		
	}
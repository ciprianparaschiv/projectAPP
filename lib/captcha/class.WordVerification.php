<?
class WordVerification {
  
  	var $section='';
  		function WordVerification($section='word_verification') {
		 	$this->section=$section;   
		}
		function makeVerifyString()
		{
			$words = array( 'cat', 'dog', 'animal', 'zoo', 'snoopy', 'keyboard', 'computer', 'mouse', 'joystick', 'at', 'tab', 'drink',
			'food', 'water', 'fall', 'pet', 'book', 'learn', 'school', 'teacher', 'screen', 'government', 'police',
			'trouble', 'double', 'triple', 'visual', 'language', 'cool', 'hot', 'cold', 'boil', 'route', 'task',
			'boss', 'create', 'edit', 'move', 'delete', 'start', 'end', 'max', 'min', 'star', 'point', 'take', 'steal',
			'borrow', 'cap', 'gun', 'fire', 'work', 'pay', 'loan', 'buy', 'soda', 'speaker', 'board', 'help', 'ask',
			'floor', 'root', 'top', 'bottom', 'queen', 'king', 'mess', 'total', 'some', 'little', 'lot', 'bunch',
			'day', 'night', 'week', 'year', 'decade', 'month', 'tide', 'wave', 'travel', 'pause', 'break', 'continue',
			'print', 'lock', 'insert', 'movie', 'show', 'cartoon', 'animate', 'mortal', 'canon', 'percent', 'dash',
			'add', 'subtract', 'divide', 'multiply', 'quote', 'comma', 'slash', 'arrow', 'lead', 'follow', 'question',
			'stupid', 'smart', 'answer', 'money', 'character', 'letter', 'paragraph', 'enter', 'exit', 'word', 'desk',
			);
			$num = count($words) - 1;

			$string = $words[ mt_rand(0, $num) ];
			$string .= '_';
			$string .= $words[ mt_rand(0, $num) ];
			$string .= mt_rand(0, 99);

			return $string;
		}

		function genVerifyImage($string='')
		{
			if(!$string) $string=$_SESSION[$this->section];
			$img['string'] = $string;
			$img['font'] = 5;
			$img['font_width'] = ImageFontWidth($img['font']);
			$img['font_height'] = ImageFontHeight($img['font']);
			$img['padding'] = 10;
			$img['img_width'] = (strlen($img['string']) * $img['font_width']) + ($img['padding'] * 2);
			$img['img_height'] = $img['font_height'] + ($img['padding'] * 2);
			$img['img'] = ImageCreateTrueColor($img['img_width'], $img['img_height']);

			////////////////////

			$colors = array('white' => ImageColorAllocate( $img['img'], 255 , 255 , 255 ),
			'black' => ImageColorAllocate( $img['img'], 0 , 0 , 0 ),
			'red' => ImageColorAllocate( $img['img'], 255 , 0 , 0 ),
			'green' => ImageColorAllocate( $img['img'], 0 , 255 , 0 ),
			'blue' => ImageColorAllocate( $img['img'], 0 , 0 , 255 ),
			'orange' => ImageColorAllocate( $img['img'], 255 , 128 , 0 ),
			'pink' => ImageColorAllocate( $img['img'], 255 , 0 , 255 ),
			'purple' => ImageColorAllocate( $img['img'], 128 , 0 , 255 ),
			'yellow' => ImageColorAllocate( $img['img'], 255 , 255 , 0 ),
			'navy' => ImageColorAllocate( $img['img'], 0 , 0 , 128 ),
			'maroon' => ImageColorAllocate( $img['img'], 128 , 0 , 0 ),
			'gold' => ImageColorAllocate( $img['img'], 128 , 128 , 0 ),
			'silver' => ImageColorAllocate( $img['img'], 192 , 192 , 192 ),
			'gray' => ImageColorAllocate( $img['img'], 128 , 128 , 128 ),
			);

			////////////////////

			// Fill for background
			ImageFill($img['img'], 0, 0, $colors['white']);

			// Create some background lines :-)
			for($x = 0; $x < $img['img_width']; $x += 20)
			{
				ImageLine($img['img'], $x, $img['img_height'], $x + 15, 0, $colors['silver']);
			}

			// Print the stirng onto it
			ImageString($img['img'], $img['font'], $img['padding'], $img['padding'], $img['string'], $colors['blue']);

			// Output it into a file
			header('Content-type: image/jpeg');
			ImageJpeg($img['img']);
		}
}
?>
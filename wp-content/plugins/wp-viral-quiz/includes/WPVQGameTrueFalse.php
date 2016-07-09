<?php

class WPVQGameTrueFalse extends WPVQGame {

	/**
	 * ----------------------------
	 * 		  ATTRIBUTS
	 * ----------------------------
	 */
	

	// ...


	/**
	 * ----------------------------
	 * 		    GETTERS
	 * ----------------------------
	 */


	function __construct()
	{
		parent::__construct();
	}


	/**
	 * Get the appreciation based on current score
	 * @return object ::Appreciation
	 */
	public function getCurrentAppreciation()
	{
		// Get the first value
		$previousValue = key($this->appreciations);
		next($this->appreciations);

		// If player gets the first appreciation
		if ($this->score <= $previousValue) {
			$appreciationRank = $previousValue;
		} 

		// else, we need to find the correct appreciation
		else {
			next($this->appreciations);
			foreach ($this->appreciations as $key => $value)
			{
				if ($this->score > $previousValue && $this->score <= $key) {
					$appreciationRank = $key;
					break;
				} else {
					$previousValue = $key;
				}
			}
		}


		return $this->appreciations[$appreciationRank];
	}


}
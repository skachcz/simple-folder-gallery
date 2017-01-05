<?php
	class Gallery {
		
		var $path;
		var $photos;
		var $allowedExtensions;
		
		function __construct($path) {
			$this->path = $path;
			$this->allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
		}

		/**
		 * Set allowed image extensions
		 *
		 * @param array $exts array of strings
		 */		
		public function setAllowedExtensions($exts) {
			$this->allowedExtensions = $exts;
		}		

		/**
		 * returns array of photos
		 */		
		public function getPhotos() {
			return $this->getPhotosLazy();
		}
		
		/**
		 * returns navigation array
		 */		
		public function getNavigation($queryKey) {
			
			$images = $this->getPhotos();
			
			if ( isset( $_GET[$queryKey] ) && !empty( $_GET[$queryKey] ) ) {
				$id = $_GET[$queryKey];
			} else {
				$id = 1;
			}
			
			$url = $images[$id]['url'];
			
			if ($images[$id]['is_last']) {
				$next = 1;
			} else {
				$next = $id+1;
			}
			
			if ($id > 1) {
				$prev = $id-1;
			} else {
				$prev = 1;
			}
			
			return array('url' => $url,
						 'prev' => $prev,
						 'next' => $next
				);
		}
	
		private function getPhotosLazy() {
			if ($this->photos === null) {
				$this->photos = $this->getImagesFromFolder($this->path);
			}
				
			return $this->photos;
		}
		
		private function getImagesFromFolder($dir) {
			$images = array();
			
			if (is_dir($dir)) { // we are checking if directory exists
			
				$isFirst = true;
				$n = 1;
				$files = scandir($dir); // scandir is slower then readdir(), but files are sorted alphabeticaly
			
				foreach($files as $entry) {
			
					if ($entry != "." && $entry != "..") {
			
						$ext = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
			
						if (in_array($ext, $this->allowedExtensions)) {
								
							$fpath = rtrim($dir,'/').'/'.$entry;
							$item = array('url' => $fpath, 'is_first' => $isFirst, 'is_last' => false);
								
							$images[$n] = $item;
							$n++;
							$isFirst = false;
						}
					}
				}
			
				if ($n > 1) {
					$images[$n-1]["is_last"] = true;
				}

			}
			
			return $images;
		} 
		
	}
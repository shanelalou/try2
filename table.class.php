<?php include 'config.php' ?>
<?php
	class Table {

		public function query($qry){
			mysql_query($qry);
		}
		
		public function showTables(){
			$result = array();
			$qry = mysql_query("show tables");
			
			while($r = mysql_fetch_array($qry)){
				$result[] = $r[0];
			}
			return $result;
		}
		
		public function showTable($columns,$table){
			$result = array();
			$qry = mysql_query("select $columns from $table");
			$columns = explode(',',str_replace(' ','',$columns));
			if(mysql_num_rows($qry)>0){
				while($r = mysql_fetch_array($qry)){
					$cells = array();
					foreach($columns as $i){
						$cells[] = $r[$i];
					}
					$result['rows'][] = $cells;
					$result['total'] = mysql_num_rows($qry);
				}
			}else{
				$result['rows'] = array();
				$result['total'] = 0;
			}
				
			$result['total'] = mysql_num_rows($qry);
			return $result;
		}
		
	}
?>
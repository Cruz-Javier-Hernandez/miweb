<?php
include 'serversideConexion.php';
class TableData
{
	private $_db;
	public function __construct()
	{
		try {
			$host		= HOST_SS;
			$database	= DATABASE_SS;
			$user		= USER_SS;
			$passwd		= PASSWORD_SS;
			$this->_db = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $passwd, array(
				PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			));
		} catch (PDOException $e) {
			error_log("Failed to connect to database: " . $e->getMessage());
		}
	}
	public function get($table, $index_column, $columns)
	{
		// Paging
		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
		}
		// Ordering
		$sOrder = "";
		if (isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
					$sortDir = (strcasecmp($_GET['sSortDir_' . $i], 'ASC') == 0) ? 'DESC' : 'ASC';
					$sOrder .= "`" . $columns[intval($_GET['iSortCol_' . $i])] . "` " . $sortDir . ", ";
				}
			}
			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
		}
		/* 
		  Filtrado
		  NOTA: esto no coincide con el filtrado integrado de DataTables que lo hace
		  palabra por palabra en cualquier campo. Es posible hacerlo aquí, pero preocupados por la eficiencia
		  en tablas muy grandes, y la funcionalidad de expresiones regulares de MySQL es muy limitada
		 */
		$sWhere = "";
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {

			$sWhere = "WHERE (";
			for ($i = 1; $i < count($columns); $i++) {
				if ($i <> 3 && $i <> 4) {
					if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
						$sWhere .= "`" . $columns[$i] . "` LIKE :search OR ";
					}
				}
			}
			$sWhere = substr_replace($sWhere, "", -3);
			$sWhere .= ')';
		}


		// Individual column filtering
		/* 		for ( $i=1 ; $i<count($columns) ; $i++ ) {
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ) {
				if ( $sWhere == "" ) {
					$sWhere = "WHERE ";
				}
				else {
					$sWhere .= " AND ";
				}
				$sWhere .= "`".$columns[$i]."` LIKE :search".$i." ";
			}
		} */

		// Verifica si la columna 'Activo' existe en la tabla
		$columnCheckQuery = "SHOW COLUMNS FROM `$table` LIKE 'Activo'";
		$columnCheckStmt = $this->_db->prepare($columnCheckQuery);
		$columnCheckStmt->execute();
		$columnExists = $columnCheckStmt->fetch(PDO::FETCH_ASSOC);

		if ($columnExists) {
			// La columna 'Activo' existe, agregar la condición al WHERE
			if (strpos($sWhere, 'WHERE') !== false) {
				$sWhere .= " AND `Activo`=1";
			} else {
				$sWhere = "WHERE `Activo`=1";
			}
		}
		// Las consultas SQL obtienen datos para mostrar
		$sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $columns)) . "` FROM `" . $table . "` " . $sWhere . " " . $sOrder . " " . $sLimit;
		$statement = $this->_db->prepare($sQuery);

		// Bind parameters
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
			$statement->bindValue(':search', '%' . $_GET['sSearch'] . '%', PDO::PARAM_STR);
		}
		for ($i = 0; $i < count($columns); $i++) {
			if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
				$statement->bindValue(':search' . $i, '%' . $_GET['sSearch_' . $i] . '%', PDO::PARAM_STR);
			}
		}

		$statement->execute();
		$rResult = $statement->fetchAll();

		$iFilteredTotal = current($this->_db->query('SELECT FOUND_ROWS()')->fetch());

		// Get total number of rows in table
		$sQuery = "SELECT COUNT(`" . $index_column . "`) FROM `" . $table . "`";
		$iTotal = current($this->_db->query($sQuery)->fetch());

		// Output
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);

		// Return array of values
		foreach ($rResult as $aRow) {
			$row = array();
			$id = 0;
			for ($i = 0; $i < count($columns); $i++) {
				$imageUrl = "";
				if ($columns[$i] == "id") {
					$id = $aRow[$columns[$i]];
				}
				if ($columns[$i] == "version") {
					// Special output formatting for 'version' column
					$row[] = ($aRow[$columns[$i]] == "0") ? '-' : $aRow[$columns[$i]];
				} else if ($columns[$i] == "codigo") {
					// Si la columna es 'Codigo', se agrega un enlace
					$codigo = $aRow[$columns[$i]];
					$enlace = "productos/HistorialProducto?codigo=$id"; // Reemplaza 'tu_url_aqui' con tu URL real

					$row[] = "<a href='$enlace' style='text-align: center; color: blue; text-decoration: underline;'>" . $aRow[$columns[$i]] . "</a>";
				} else if ($columns[$i] == "imagen") {
					// Assuming 'imagen' is the column with image URLs
					$imageUrl = '/calzados/' . $aRow[$columns[$i]];

					if ($aRow[$columns[$i]]) {
						// Agrega un identificador único para cada imagen
						$row[] = "<div style='text-align: center;'><img src='$imageUrl' style='width: 80%;' alt='img' onclick='mostrarImagenCompleta(\"$imageUrl\")'></div>";
					} else {
						
						//$row[] = "<div style='text-align: center;'><img src='\calzados\assets\img\descarga.png' style='max-width: 50%;' alt='imagen'></div>";
						$row[] = "";
					}
				} else if ($columns[$i] != ' ') {
					$row[] = $aRow[$columns[$i]];
				}
				// Si el nombre de la columna es 'id', agregamos una clase para ocultarla
				if ($columns[$i] == 'id') {
					$row[count($row) - 1] = "<td style='display: none;' >" . $row[count($row) - 1] . "</td>";
				}
			}
			$output['aaData'][] = $row;
		}
		echo json_encode($output);
	}
}
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
// Create instance of TableData class
$table_data = new TableData();


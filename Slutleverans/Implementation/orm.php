<?php
/**
 * ORM is a simple object relation mapping object.
 * 
 * @author Emil Carlsson
 * @license GPL3
 * @throws
 */
class ORM extends QueryTypes {
	/* Insert user and database credentials here*/
	
	
	private static $db_hst = ""; //Database host name.
	private static $db_usrnm = ""; //Database user name.
	private static $db_pswd = ""; //Database password.
	private static $db_dbnm = ""; //Database name.
	private static $db_prfx = ""; //Database prefix (leave empty if none).
	
	/*Do not change below this unless you know what the change involve*/

	private $queryType;
	private $query;
	private $connection;
	private $tableName;
	private $database;
	private $fields;
	private $values;
	private $username;
	private $password;
	private $host;
	private $errorMsg;
	private $errorNo;
	private $result;
	private $where = false;
	private $limit = 30;
	private $order = false;
	
	/**
	 * Initialize a new object of the ORM class with a working mysql connection.
	 */
	public function __construct() {		
		$this->connect();
	}
	
	/**
	 * Creates a connection with the predefined user credentials.
	 */
	private function connect() {
		$this->connection = new mysqli(self::$db_hst, self::$db_usrnm, self::$db_pswd, self::$db_dbnm);
	}
	
	/**
	 * Initialize a new SELECT query.
	 * 
	 * @param $fields array The fields that should be selected in an array where each value is a field name.
	 * @param $tableName String Default null. Name of the table to select from.
	 * 
	 * @return ORM object.
	 */
	public function select($fields = array(), $tableName = NULL) {
		$this->queryType = self::SELECT;
		
		$this->setFields($fields);
		
		if ($tableName != NULL)
			$this->setTableName($tableName);
		
		return $this;
	}
	
	/**
	 * Initialize a new INSERT query.
	 * 
	 * @param $fieldValuePair Array Associative array of field => data to insert. Key is field, value is data.
	 * @param $tableName String Default null. Name of the table to insert into.
	 * 
	 * @return ORM object.
	 */
	public function insert($fieldValuePair, $tableName = NULL) {
		$this->queryType = self::INSERT;
		$this->setFieldsValuePair($fieldValuePair);
		
		if ($tableName != NULL)
			$this->setTableName($tableName);
		
		return $this;
	}
	
	/**
	 * Initialize a new UPDATE query.
	 * 
	 * @param $fieldValuePair Array Associative array of field => data to update. Key is field, value is data.
	 * @param $tableName String Default null. Name of the table to update.
	 * 
	 * @return ORM object.
	 */
	public function update($fieldValuePair, $tableName = NULL) {
		$this->queryType = self::UPDATE;
		$this->setFieldsValuePair($fieldValuePair);
		
		if ($tableName != NULL)
			$this->setTableName($tableName);
				
		return $this;
	}
	
	/**
	 * Initialize a new DELETE query.
	 *
	 * @param $tableName String Default null. Name of the table to delete from.
	 * 
	 * @return ORM object.
	 */
	public function delete($tableName = NULL) {
		$this->queryType = self::DELETE;
		
		if ($tableName != NULL)
			$this->setTableName($tableName);
		
		return $this;
	}
	
	/**
	 * Set the table to perform a query against.
	 * Synonymous with the function setTableName.
	 * 
	 * @param $tableName String
	 * 
	 * @return ORM object.
	 */
	public function from($tableName) {
		return $this->setTableName($tableName);
	}
	
	/**
	 * Set the table to perform a query against.
	 * Synonymous with the function setTableName.
	 * 
	 * @param $tableName String
	 * 
	 * @return ORM object.
	 */
	public function into($tableName) {
		return $this->from($tableName);
	}
	
	/**
	 * Set a where clause in a query.
	 * 
	 * @param $whereClause String The where specification. Use format "fieldName = condition" or "fieldName LIKE condition" etc.
	 * 
	 * @return ORM object.
	 */
	public function where($whereClause) {
		$this->where .= $whereClause.' ';
		
		return $this;
	}
	
	/**
	 * Set the table name to perform queries against.
	 * 
	 * @param $tableName String Name of the table to use when performing queries.
	 * 
	 * @return ORM object.
	 */
	public function setTableName($tableName) {
		$tableName = self::$db_prfx . $tableName;
		$this->tableName = '`'.$tableName.'`';
		
		return $this;
	}
	
	/**
	 * Set a field that the query should be ordered by.
	 * 
	 * @param $field String Name of the field to order by.
	 * @param $asc Boolean Defaults to true. Specifies if the order should be ascending or descending.
	 * 
	 * @return ORM object.
	 */
	public function orderBy($field, $asc = true) {
		$this->order = $field. ' ' . ($asc) ? 'ASC' : 'DESC';
		
		return $this;
	}
	
	/**
	 * Executes the query built up.
	 * 
	 * @return ORM object.
	 * @throws
	 */
	public function executeQuery() {

		$this->result = $this->connection->query($this->getQuery());
		
		if (!$this->result) {
			$this->connect();			
			$this->result = $this->connection->query($this->getQuery());
			
			if (!$this->result) {
				$this->errorMsg = $this->connection->error;
				$this->errorNo = $this->connection->errno;
				
				throw new Exception('Error when executing the query. Error no: '.$this->errorNo);
			}
		} else {
			$this->errorMsg = null;
			$this->errorNo = null;
		}
		
		return $this;
	}
	
	/**
	 * Returns the latest inserted ID in the database.
	 * 
	 * @return Mixed
	 */
	public function getLastInsertedId() {
		$result = $this->connection->insert_id;
		if (!$result) {
			$this->connect();
			$result = $this->connection->insert_id;
		}
		
		return $result;
	}
	
	/**
	 * Return the result of the query in an array of associative arrays.
	 * @see MYSQLI_ASSOC
	 * 
	 * @return Array
	 * @throws
	 */
	public function getResultArray() {
		if ($this->errorMsg == null) {
			return $this->result->fetch_all(MYSQLI_ASSOC);
		} else{
			throw new Exception($this->errorMsg);
		}
	}
	
	/**
	 * Return the result as a stdClass in an array.
	 * 
	 * @return stdClass
	 * @throws
	 */
	public function getResultObject() {
		if ($this->errorMsg == null) {
			$objArray = array();
			$result = $this->result->fetch_all(MYSQLI_ASSOC);
			
			foreach ($result as $value) {
				$objArray[] = json_decode(json_encode($value), FALSE);
 			}
			
			return $objArray;
		} else{
			throw new Exception($this->errorMsg);
		}
	}
	
	/**
	 * Returns the first result of a query as an associative array.
	 * 
	 * @return Array
	 * @throws
	 */
	public function getSingleResultArray() {
		$result = $this->getResultArray();
		if ($result)
			return $result[0];
		else 
			throw new Exception("No results");
	}
	
	/**
	 * Returns the first result as an stdClass object.
	 * 
	 * @return stdClass
	 * @throws
	 */
	public function getSingleResultObject() {
		$result = $this->getResultObject();
		if ($result)
			return $result[0];
		else 			
			throw new Exception("No results found");
	}
	
	/**
	 * Set the field value pair of the query.
	 * 
	 * @param $fieldValuePair Array
	 */
	private function setFieldsValuePair($fieldValuePair) {		
		$this->setFields(array_keys($fieldValuePair));
		$this->setValues(array_values($fieldValuePair));
	}
	
	/**
	 * Set fields to be used in the query.
	 * 
	 * @param $fields Array
	 */
	private function setFields($fields) {
		if (is_array($fields))
			$this->fields = $fields;
		else 
			$this->fields[] = $fields;
	}
	
	/**
	 * Set the values paired to a field.
	 * 
	 * @param $values Array
	 */
	private function setValues($values) {
		$escapedValues = array();

		foreach($values as $key => $value) {
			if (is_numeric($value)) {
				$escapedValues[$key] = $value;
			} else {
				$escapedString = $this->connection->real_escape_string($value);
				if (!$escapedString) {
					$this->connect();
					$escapedString = $this->connection->real_escape_string($value);
				}
				$escapedValues[$key] = $escapedString;
			}
		}
		$this->values = $escapedValues;
	}
	
	/**
	 * Set the limit of the results to be fetched.
	 * 
	 * @param $limit Integer
	 * 
	 * @return ORM object
	 */
	public function limit($limit = 30) {
		if (is_int($limit)) {
			$this->limit = $limit;
		}
		
		return $this;
	}
	
	/**
	 * Returns the query built at the time the query is asked for.
	 * 
	 * @return String SQL query as a string.
	 */
	public function getQuery() {
		$query;
		
		switch ($this->queryType) {
			case QueryTypes::INSERT:
				$query = $this->getInsertQuery();
				break;
			case QueryTypes::DELETE:
				$query = $this->getDeleteQuery();
				break;
			case QueryTypes::UPDATE:
				$query = $this->getUpdateQuery();
				break;
			default:
				$query = $this->getSelectQuery();
				break;
		}
		
		return $query;
	}
	
	/**
	 * Constructs a string containing the SQL query used for an insert query.
	 * 
	 * @return String
	 */
	private function getInsertQuery() {
		return 'INSERT INTO '.$this->tableName.'(`'.implode('`, `', $this->fields).'`) VALUES (\''.implode('\', \'', $this->values).'\')';
	}
	
	/**
	 * Constructs a string containing the SQL query used for an delete query.
	 * 
	 * @return String
	 */
	private function getDeleteQuery() {
		$query = 'DELETE FROM '.$this->tableName.' WHERE '.$this->where.' ';
		$query .= ($this->order) ? 'ORDER BY ' .$this->order .' ' : '';
		$query .= 'LIMIT '. $this->limit.';';
		
		return $query;
	}
	
	/**
	 * Constructs a string containing the SQL query used for an update query.
	 * 
	 * @return String
	 */
	private function getUpdateQuery() {
		$query = 'UPDATE '.$this->tableName.' SET ';
		
		for ($i = 0; $i < count($this->fields); $i++) {
			$value = $this->connection->real_escape_string($this->values[$i]);
			if (!$value) {
				$this->connect();
				$value = $this->connection->real_escape_string($this->values[$i]);
			}
			
			$query .= '`'.$this->fields[$i].'`=\''.$value.'\', ';
		}
		
		$query = substr($query, 0, strlen($query) - 2) . ' ';
		
		$query .= 'WHERE '.$this->where.' LIMIT '.$this->limit .';';
		
		return $query;
	}
	
	/**
	 * Constructs a string containing the SQL query used for an select query.
	 * 
	 * @return String
	 */
	private function getSelectQuery() {
		$query = 'SELECT ';
		$query .= (empty($this->fields)) ? '* ' : '`'.implode('`, `', $this->fields).'` ';
		$query .= 'FROM '.$this->tableName.' ';
		$query .= ($this->where) ? 'WHERE '.$this->where : ' ';
		$query .= ($this->order) ? $this->order : '';
		$query .= 'LIMIT '. $this->limit .';';
		
		return $query;
	}
	
	/**
	 * Returns the raw SQL error message
	 * 
	 * @return String
	 */
	 public function getSQLErrorMessage() {
	 	return $this->errorMsg;
	 }
	 
	/**
	 * Returns the raw SQL error number
	 * 
	 * @return Integer
	 */
	 public function getSQLErrorNumber() {
	 	return $this->errorNo;
	 }
}

abstract class QueryTypes {
	const SELECT = 1;
	const INSERT = 2;
	const UPDATE = 3;
	const DELETE = 4;
}

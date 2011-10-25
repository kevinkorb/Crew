<?php


/**
 * Base class that represents a row from the 'branch' table.
 *
 * 
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseBranch extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'BranchPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BranchPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id;

	/**
	 * The value for the user_status_changed field.
	 * @var        int
	 */
	protected $user_status_changed;

	/**
	 * The value for the repository_id field.
	 * @var        int
	 */
	protected $repository_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the commit_reference field.
	 * @var        string
	 */
	protected $commit_reference;

	/**
	 * The value for the commit_status_changed field.
	 * @var        string
	 */
	protected $commit_status_changed;

	/**
	 * The value for the date_status_changed field.
	 * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
	 * @var        string
	 */
	protected $date_status_changed;

	/**
	 * The value for the is_blacklisted field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_blacklisted;

	/**
	 * The value for the review_request field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $review_request;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        Repository
	 */
	protected $aRepository;

	/**
	 * @var        array BranchComment[] Collection to store aggregation of BranchComment objects.
	 */
	protected $collBranchComments;

	/**
	 * @var        array File[] Collection to store aggregation of File objects.
	 */
	protected $collFiles;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_blacklisted = 0;
		$this->review_request = 0;
	}

	/**
	 * Initializes internal state of BaseBranch object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{
		return $this->status_id;
	}

	/**
	 * Get the [user_status_changed] column value.
	 * 
	 * @return     int
	 */
	public function getUserStatusChanged()
	{
		return $this->user_status_changed;
	}

	/**
	 * Get the [repository_id] column value.
	 * 
	 * @return     int
	 */
	public function getRepositoryId()
	{
		return $this->repository_id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [commit_reference] column value.
	 * 
	 * @return     string
	 */
	public function getCommitReference()
	{
		return $this->commit_reference;
	}

	/**
	 * Get the [commit_status_changed] column value.
	 * 
	 * @return     string
	 */
	public function getCommitStatusChanged()
	{
		return $this->commit_status_changed;
	}

	/**
	 * Get the [optionally formatted] temporal [date_status_changed] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDateStatusChanged($format = 'Y-m-d H:i:s')
	{
		if ($this->date_status_changed === null) {
			return null;
		}


		if ($this->date_status_changed === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->date_status_changed);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_status_changed, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [is_blacklisted] column value.
	 * 
	 * @return     int
	 */
	public function getIsBlacklisted()
	{
		return $this->is_blacklisted;
	}

	/**
	 * Get the [review_request] column value.
	 * 
	 * @return     int
	 */
	public function getReviewRequest()
	{
		return $this->review_request;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BranchPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setStatusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = BranchPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

		return $this;
	} // setStatusId()

	/**
	 * Set the value of [user_status_changed] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setUserStatusChanged($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_status_changed !== $v) {
			$this->user_status_changed = $v;
			$this->modifiedColumns[] = BranchPeer::USER_STATUS_CHANGED;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserStatusChanged()

	/**
	 * Set the value of [repository_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setRepositoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->repository_id !== $v) {
			$this->repository_id = $v;
			$this->modifiedColumns[] = BranchPeer::REPOSITORY_ID;
		}

		if ($this->aRepository !== null && $this->aRepository->getId() !== $v) {
			$this->aRepository = null;
		}

		return $this;
	} // setRepositoryId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = BranchPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [commit_reference] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setCommitReference($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->commit_reference !== $v) {
			$this->commit_reference = $v;
			$this->modifiedColumns[] = BranchPeer::COMMIT_REFERENCE;
		}

		return $this;
	} // setCommitReference()

	/**
	 * Set the value of [commit_status_changed] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setCommitStatusChanged($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->commit_status_changed !== $v) {
			$this->commit_status_changed = $v;
			$this->modifiedColumns[] = BranchPeer::COMMIT_STATUS_CHANGED;
		}

		return $this;
	} // setCommitStatusChanged()

	/**
	 * Sets the value of [date_status_changed] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setDateStatusChanged($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->date_status_changed !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->date_status_changed !== null && $tmpDt = new DateTime($this->date_status_changed)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->date_status_changed = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = BranchPeer::DATE_STATUS_CHANGED;
			}
		} // if either are not null

		return $this;
	} // setDateStatusChanged()

	/**
	 * Set the value of [is_blacklisted] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setIsBlacklisted($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_blacklisted !== $v || $this->isNew()) {
			$this->is_blacklisted = $v;
			$this->modifiedColumns[] = BranchPeer::IS_BLACKLISTED;
		}

		return $this;
	} // setIsBlacklisted()

	/**
	 * Set the value of [review_request] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setReviewRequest($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->review_request !== $v || $this->isNew()) {
			$this->review_request = $v;
			$this->modifiedColumns[] = BranchPeer::REVIEW_REQUEST;
		}

		return $this;
	} // setReviewRequest()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->is_blacklisted !== 0) {
				return false;
			}

			if ($this->review_request !== 0) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->status_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->user_status_changed = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->repository_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->commit_reference = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->commit_status_changed = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->date_status_changed = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->is_blacklisted = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->review_request = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 10; // 10 = BranchPeer::NUM_COLUMNS - BranchPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Branch object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aStatus !== null && $this->status_id !== $this->aStatus->getId()) {
			$this->aStatus = null;
		}
		if ($this->asfGuardUser !== null && $this->user_status_changed !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aRepository !== null && $this->repository_id !== $this->aRepository->getId()) {
			$this->aRepository = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = BranchPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aStatus = null;
			$this->asfGuardUser = null;
			$this->aRepository = null;
			$this->collBranchComments = null;

			$this->collFiles = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBranch:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			    return;
			  }
			}

			if ($ret) {
				BranchQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseBranch:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBranch:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			  	$con->commit();
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseBranch:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				BranchPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified() || $this->aStatus->isNew()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aRepository !== null) {
				if ($this->aRepository->isModified() || $this->aRepository->isNew()) {
					$affectedRows += $this->aRepository->save($con);
				}
				$this->setRepository($this->aRepository);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = BranchPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(BranchPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.BranchPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += BranchPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collBranchComments !== null) {
				foreach ($this->collBranchComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFiles !== null) {
				foreach ($this->collFiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aRepository !== null) {
				if (!$this->aRepository->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepository->getValidationFailures());
				}
			}


			if (($retval = BranchPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBranchComments !== null) {
					foreach ($this->collBranchComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFiles !== null) {
					foreach ($this->collFiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BranchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getStatusId();
				break;
			case 2:
				return $this->getUserStatusChanged();
				break;
			case 3:
				return $this->getRepositoryId();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getCommitReference();
				break;
			case 6:
				return $this->getCommitStatusChanged();
				break;
			case 7:
				return $this->getDateStatusChanged();
				break;
			case 8:
				return $this->getIsBlacklisted();
				break;
			case 9:
				return $this->getReviewRequest();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $includeForeignObjects = false)
	{
		$keys = BranchPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getStatusId(),
			$keys[2] => $this->getUserStatusChanged(),
			$keys[3] => $this->getRepositoryId(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getCommitReference(),
			$keys[6] => $this->getCommitStatusChanged(),
			$keys[7] => $this->getDateStatusChanged(),
			$keys[8] => $this->getIsBlacklisted(),
			$keys[9] => $this->getReviewRequest(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aStatus) {
				$result['Status'] = $this->aStatus->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->asfGuardUser) {
				$result['sfGuardUser'] = $this->asfGuardUser->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aRepository) {
				$result['Repository'] = $this->aRepository->toArray($keyType, $includeLazyLoadColumns, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BranchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setStatusId($value);
				break;
			case 2:
				$this->setUserStatusChanged($value);
				break;
			case 3:
				$this->setRepositoryId($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setCommitReference($value);
				break;
			case 6:
				$this->setCommitStatusChanged($value);
				break;
			case 7:
				$this->setDateStatusChanged($value);
				break;
			case 8:
				$this->setIsBlacklisted($value);
				break;
			case 9:
				$this->setReviewRequest($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BranchPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStatusId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserStatusChanged($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRepositoryId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCommitReference($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCommitStatusChanged($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDateStatusChanged($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsBlacklisted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setReviewRequest($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BranchPeer::DATABASE_NAME);

		if ($this->isColumnModified(BranchPeer::ID)) $criteria->add(BranchPeer::ID, $this->id);
		if ($this->isColumnModified(BranchPeer::STATUS_ID)) $criteria->add(BranchPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(BranchPeer::USER_STATUS_CHANGED)) $criteria->add(BranchPeer::USER_STATUS_CHANGED, $this->user_status_changed);
		if ($this->isColumnModified(BranchPeer::REPOSITORY_ID)) $criteria->add(BranchPeer::REPOSITORY_ID, $this->repository_id);
		if ($this->isColumnModified(BranchPeer::NAME)) $criteria->add(BranchPeer::NAME, $this->name);
		if ($this->isColumnModified(BranchPeer::COMMIT_REFERENCE)) $criteria->add(BranchPeer::COMMIT_REFERENCE, $this->commit_reference);
		if ($this->isColumnModified(BranchPeer::COMMIT_STATUS_CHANGED)) $criteria->add(BranchPeer::COMMIT_STATUS_CHANGED, $this->commit_status_changed);
		if ($this->isColumnModified(BranchPeer::DATE_STATUS_CHANGED)) $criteria->add(BranchPeer::DATE_STATUS_CHANGED, $this->date_status_changed);
		if ($this->isColumnModified(BranchPeer::IS_BLACKLISTED)) $criteria->add(BranchPeer::IS_BLACKLISTED, $this->is_blacklisted);
		if ($this->isColumnModified(BranchPeer::REVIEW_REQUEST)) $criteria->add(BranchPeer::REVIEW_REQUEST, $this->review_request);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BranchPeer::DATABASE_NAME);
		$criteria->add(BranchPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Branch (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setStatusId($this->status_id);
		$copyObj->setUserStatusChanged($this->user_status_changed);
		$copyObj->setRepositoryId($this->repository_id);
		$copyObj->setName($this->name);
		$copyObj->setCommitReference($this->commit_reference);
		$copyObj->setCommitStatusChanged($this->commit_status_changed);
		$copyObj->setDateStatusChanged($this->date_status_changed);
		$copyObj->setIsBlacklisted($this->is_blacklisted);
		$copyObj->setReviewRequest($this->review_request);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getBranchComments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addBranchComment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFiles() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFile($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);
		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Branch Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     BranchPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BranchPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Status object.
	 *
	 * @param      Status $v
	 * @return     Branch The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setStatus(Status $v = null)
	{
		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}

		$this->aStatus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Status object, it will not be re-added.
		if ($v !== null) {
			$v->addBranch($this);
		}

		return $this;
	}


	/**
	 * Get the associated Status object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Status The associated Status object.
	 * @throws     PropelException
	 */
	public function getStatus(PropelPDO $con = null)
	{
		if ($this->aStatus === null && ($this->status_id !== null)) {
			$this->aStatus = StatusQuery::create()->findPk($this->status_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aStatus->addBranchs($this);
			 */
		}
		return $this->aStatus;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Branch The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserStatusChanged(NULL);
		} else {
			$this->setUserStatusChanged($v->getId());
		}

		$this->asfGuardUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addBranch($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfGuardUser object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfGuardUser The associated sfGuardUser object.
	 * @throws     PropelException
	 */
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_status_changed !== null)) {
			$this->asfGuardUser = sfGuardUserQuery::create()->findPk($this->user_status_changed, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->asfGuardUser->addBranchs($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Declares an association between this object and a Repository object.
	 *
	 * @param      Repository $v
	 * @return     Branch The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepository(Repository $v = null)
	{
		if ($v === null) {
			$this->setRepositoryId(NULL);
		} else {
			$this->setRepositoryId($v->getId());
		}

		$this->aRepository = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Repository object, it will not be re-added.
		if ($v !== null) {
			$v->addBranch($this);
		}

		return $this;
	}


	/**
	 * Get the associated Repository object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Repository The associated Repository object.
	 * @throws     PropelException
	 */
	public function getRepository(PropelPDO $con = null)
	{
		if ($this->aRepository === null && ($this->repository_id !== null)) {
			$this->aRepository = RepositoryQuery::create()->findPk($this->repository_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aRepository->addBranchs($this);
			 */
		}
		return $this->aRepository;
	}

	/**
	 * Clears out the collBranchComments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addBranchComments()
	 */
	public function clearBranchComments()
	{
		$this->collBranchComments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collBranchComments collection.
	 *
	 * By default this just sets the collBranchComments collection to an empty array (like clearcollBranchComments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initBranchComments()
	{
		$this->collBranchComments = new PropelObjectCollection();
		$this->collBranchComments->setModel('BranchComment');
	}

	/**
	 * Gets an array of BranchComment objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Branch is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array BranchComment[] List of BranchComment objects
	 * @throws     PropelException
	 */
	public function getBranchComments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collBranchComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collBranchComments) {
				// return empty collection
				$this->initBranchComments();
			} else {
				$collBranchComments = BranchCommentQuery::create(null, $criteria)
					->filterByBranch($this)
					->find($con);
				if (null !== $criteria) {
					return $collBranchComments;
				}
				$this->collBranchComments = $collBranchComments;
			}
		}
		return $this->collBranchComments;
	}

	/**
	 * Returns the number of related BranchComment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related BranchComment objects.
	 * @throws     PropelException
	 */
	public function countBranchComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collBranchComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collBranchComments) {
				return 0;
			} else {
				$query = BranchCommentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByBranch($this)
					->count($con);
			}
		} else {
			return count($this->collBranchComments);
		}
	}

	/**
	 * Method called to associate a BranchComment object to this object
	 * through the BranchComment foreign key attribute.
	 *
	 * @param      BranchComment $l BranchComment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addBranchComment(BranchComment $l)
	{
		if ($this->collBranchComments === null) {
			$this->initBranchComments();
		}
		if (!$this->collBranchComments->contains($l)) { // only add it if the **same** object is not already associated
			$this->collBranchComments[]= $l;
			$l->setBranch($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related BranchComments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array BranchComment[] List of BranchComment objects
	 */
	public function getBranchCommentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = BranchCommentQuery::create(null, $criteria);
		$query->joinWith('sfGuardUser', $join_behavior);

		return $this->getBranchComments($query, $con);
	}

	/**
	 * Clears out the collFiles collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFiles()
	 */
	public function clearFiles()
	{
		$this->collFiles = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFiles collection.
	 *
	 * By default this just sets the collFiles collection to an empty array (like clearcollFiles());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFiles()
	{
		$this->collFiles = new PropelObjectCollection();
		$this->collFiles->setModel('File');
	}

	/**
	 * Gets an array of File objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Branch is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array File[] List of File objects
	 * @throws     PropelException
	 */
	public function getFiles($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collFiles || null !== $criteria) {
			if ($this->isNew() && null === $this->collFiles) {
				// return empty collection
				$this->initFiles();
			} else {
				$collFiles = FileQuery::create(null, $criteria)
					->filterByBranch($this)
					->find($con);
				if (null !== $criteria) {
					return $collFiles;
				}
				$this->collFiles = $collFiles;
			}
		}
		return $this->collFiles;
	}

	/**
	 * Returns the number of related File objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related File objects.
	 * @throws     PropelException
	 */
	public function countFiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collFiles || null !== $criteria) {
			if ($this->isNew() && null === $this->collFiles) {
				return 0;
			} else {
				$query = FileQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByBranch($this)
					->count($con);
			}
		} else {
			return count($this->collFiles);
		}
	}

	/**
	 * Method called to associate a File object to this object
	 * through the File foreign key attribute.
	 *
	 * @param      File $l File
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFile(File $l)
	{
		if ($this->collFiles === null) {
			$this->initFiles();
		}
		if (!$this->collFiles->contains($l)) { // only add it if the **same** object is not already associated
			$this->collFiles[]= $l;
			$l->setBranch($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array File[] List of File objects
	 */
	public function getFilesJoinStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FileQuery::create(null, $criteria);
		$query->joinWith('Status', $join_behavior);

		return $this->getFiles($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->status_id = null;
		$this->user_status_changed = null;
		$this->repository_id = null;
		$this->name = null;
		$this->commit_reference = null;
		$this->commit_status_changed = null;
		$this->date_status_changed = null;
		$this->is_blacklisted = null;
		$this->review_request = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collBranchComments) {
				foreach ((array) $this->collBranchComments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFiles) {
				foreach ((array) $this->collFiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collBranchComments = null;
		$this->collFiles = null;
		$this->aStatus = null;
		$this->asfGuardUser = null;
		$this->aRepository = null;
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		// symfony_behaviors behavior
		if ($callable = sfMixer::getCallable('BaseBranch:' . $name))
		{
		  array_unshift($params, $this);
		  return call_user_func_array($callable, $params);
		}

		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseBranch
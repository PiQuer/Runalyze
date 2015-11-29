<?php

namespace Runalyze\Model\Sport;

use PDO;

class InvalidInserterObjectForSport_MockTester extends \Runalyze\Model\Object {
	public function properties() {
		return array('foo');
	}
}

/**
 * Generated by hand
 */
class InserterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var \PDO
	 */
	protected $PDO;

	protected function setUp() {
		$this->PDO = new PDO('sqlite::memory:');
		$this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->PDO->exec('CREATE TABLE IF NOT EXISTS `'.PREFIX.'sport` (
			`id` INTEGER PRIMARY KEY AUTOINCREMENT,
			`name` VARCHAR(50) NOT NULL,
			`img` VARCHAR(50) NOT NULL,
			`short` TINYINT NOT NULL,
			`kcal` SMALLINT NOT NULL,
			`HFavg` SMALLINT NOT NULL,
			`distances` SMALLINT NOT NULL,
			`speed` VARCHAR(10) NOT NULL,
			`power` TINYINT NOT NULL,
			`outside` TINYINT NOT NULL,
			`main_equipmenttypeid` INTEGER NOT NULL,
			`accountid` INTEGER NOT NULL
			);
		');
	}

	protected function tearDown() {
		$this->PDO->exec('DROP TABLE `'.PREFIX.'sport`');
	}

	/**
	 * @expectedException \PHPUnit_Framework_Error
	 */
	public function testWrongObject() {
		new Inserter($this->PDO, new InvalidInserterObjectForSport_MockTester);
	}

	public function testSimpleInsert() {
		$Object = new Object(array(
			Object::NAME => 'Sport name',
			Object::SHORT => 0,
			Object::CALORIES_PER_HOUR => 700,
			Object::HR_AVG => 140,
			Object::HAS_DISTANCES => 1,
			Object::PACE_UNIT => 'foo',
			Object::HAS_POWER => 0,
			Object::IS_OUTSIDE => 1
		));

		$Inserter = new Inserter($this->PDO, $Object);
		$Inserter->setAccountID(1);
		$Inserter->insert();

		$data = $this->PDO->query('SELECT * FROM `'.PREFIX.'sport` WHERE `accountid`=1')->fetch(PDO::FETCH_ASSOC);
		$Sport = new Object($data);

		$this->assertEquals('Sport name', $Sport->name());
		$this->assertEquals(700, $Sport->caloriesPerHour());
		$this->assertEquals(140, $Sport->avgHR());
		$this->assertEquals('foo', $Sport->paceUnitEnum());

		$this->assertTrue($Sport->hasDistances());
		$this->assertTrue($Sport->isOutside());

		$this->assertFalse($Sport->usesShortDisplay());
		$this->assertFalse($Sport->hasPower());
	}

}

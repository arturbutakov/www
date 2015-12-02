<?
class Model_Timetable extends Model
{
    public function __construct()
    {
        $this->db_connect();
    }
    public function getEvent()
    {   
        $query = $this->DBH->prepare("SELECT * FROM event");
        $query->execute();
        $eventdata = $query->fetchAll(PDO::FETCH_ASSOC);
        return $eventdata;
    }
    public function addMark($id)
    {   
        $query = $this->DBH->prepare("INSERT INTO marks SET event_id=:id"); 
        $query->bindParam(':id', $id);
        $query->execute();
    }
    public function addEvent($name, $dateYMD, $description, $task)
    {
        $query = $this->DBH->prepare("INSERT INTO event SET name=:name,date=:dateYMD,description=:description,task=:task");
        $query->bindParam(':name', $name);
        $query->bindParam(':dateYMD', $dateYMD);
        $query->bindParam(':description', $description);
        $query->bindParam(':task', $task);
        $query->execute();
        $lastid = $this->DBH->lastInsertId();
        $this->addMark($lastid);
    }
}
?>
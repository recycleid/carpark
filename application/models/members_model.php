<?php

class members_model extends CI_Model {

        public function get_memtype()
        {
                $sql = "SELECT * FROM membertype ";
                return $this->db->query($sql)->result_array();
        }

        public function check_memtype($memtype)
        {
                $sql = "SELECT * FROM membertype WHERE memtype ='$memtype' ";
                return $this->db->query($sql)->result_array();
        }

        public function check_memtypeBytypeid($memtype,$id)
        {
                $sql = "SELECT * FROM membertype WHERE memtype ='$memtype' and ID<>'$id' ";
                return $this->db->query($sql)->result_array();
        }

        public function edit_Memtype($var,$id)
        {
          $this->db->where('ID', $id);
          $this->db->update('membertype', $var);
        }

        public function get_member()
        {
                $sql = "SELECT * FROM member ";
                return $this->db->query($sql)->result_array();
        }

        public function get_memberCard($id)
        {
                $sql = "SELECT * FROM membercar
                left join member on membercar.memberID = member.memID
                left join membertype on membertype.ID = member.memType
                left join park on membercar.parkPosition = park.ID
                 where memberID = '$id'";
                return $this->db->query($sql)->result_array();
        }

        public function load_Member($id)
        {
                $sql = "SELECT * FROM member WHERE memID='$id'";
                return $this->db->query($sql)->result_array();
        }

        public function get_priority($id)
        {
                $sql = "SELECT * FROM zonepriority WHERE memtypeID='$id' ORDER BY priority";
                return $this->db->query($sql)->result_array();
        }

        public function get_zonePriority($id)
        {
                $sql = "select zone
                from zone
                where zone not in (select zone from zonepriority where memtypeID = '$id')";
                return $this->db->query($sql)->result_array();
        }

        public function get_zonePrioritynumber($id)
        {
                $sql = "select count(priority) as p from zonepriority where memtypeID = '$id'";
                return $this->db->query($sql)->result_array();
        }

        public function get_transactionByID($id)
        {
                $sql = "SELECT tranIN,keymanIN,tranOUT,keymanOUT,timepark,carRegis,CONCAT(zone,number) as parkPosition,price FROM transaction
                LEFT JOIN park on park.ID = transaction.parkPosition
                WHERE memID='$id'";
                return $this->db->query($sql)->result_array();
        }

        public function load_parking()
        {
                $sql = "SELECT ID,CONCAT(zone,number) as parking FROM park WHERE status in ('1','0')";
                return $this->db->query($sql)->result_array();
        }

        public function load_Membercar($id)
        {
                $sql = "SELECT memberCar.ID,park.ID as IDS,CONCAT(zone,number) as parking,carRegistration FROM memberCar
                LEFT JOIN park on park.ID = memberCar.parkPosition
                WHERE memberID='$id'";
                return $this->db->query($sql)->result_array();
        }

        public function get_typeBymember($member)
        {
                $sql = "SELECT * FROM membertype WHERE memtype like '%$member%' ";
                return $this->db->query($sql)->result_array();
        }

        public function check_memtypeByid($member)
        {
                $sql = "SELECT * FROM membertype WHERE ID like '$member' ";
                return $this->db->query($sql)->result_array();
        }

        public function get_registerByregis($regis)
        {
                $sql = "SELECT * FROM memberCar WHERE carRegistration like '%$regis%' ";
                return $this->db->query($sql)->result_array();
        }

        public function new_Memtype($data)
        {
                $this->db->insert('membertype', $data);
        }

        public function create_priority($data)
        {
                $this->db->insert('zonepriority', $data);
        }

        public function new_parking($data)
        {
                $this->db->insert('membercar', $data);
        }

        public function new_Member($data)
        {
                $this->db->insert('member', $data);
        }

        public function update_Member($data,$id)
        {

                $this->db->where('memID', $id);
                $this->db->update('member', $data);
        }

        public function update_Park($id,$data)
        {

                $this->db->where('ID', $id);
                $this->db->update('park', $data);
        }

        public function del_parking($id,$data)
        {

                $this->db->where('ID', $id);
                $this->db->delete('membercar');
        }

        public function bye_priority($id,$zone)
        {

                $this->db->where('zone', $zone);
                $this->db->where('memtypeID', $id);
                $this->db->delete('zonepriority');
        }

        public function levelup_priority($id,$zone,$priority)
        {
                $var = array(
                  'priority' => $priority
                );
                $this->db->where('priority', $priority-1);
                $this->db->where('memtypeID', $id);
                $this->db->update('zonepriority', $var);

                $var = array(
                  'priority' => $priority-1
                );
                $this->db->where('zone', $zone);
                $this->db->where('memtypeID', $id);
                $this->db->update('zonepriority', $var);
        }


}


?>

<?php

class transactions_model extends CI_Model {

       public function get_transacByregis($regis)
        {
                $sql = "SELECT * FROM transaction WHERE carRegis like '$regis' AND tranOUT is null ";
                return $this->db->query($sql)->result_array();
        }

        public function get_transacByID($regis,$tin)
         {
                 $sql = "SELECT * FROM transaction WHERE carRegis like '$regis' AND tranIN = '$tin' ";
                 $data = $this->db->query($sql)->result_array();

                 return $data[0]["ID"];
         }

        public function get_transacByregisout($regis)
        {
                $sql = "SELECT transaction.ID,tranIN,tranOUT,keymanIN,keymanOUT,timepark,memID,carRegis,CONCAT(park.zone,park.number) as parkPosition,park.ID as IDP,price,pathin,pathout
                FROM transaction
                LEFT JOIN park on transaction.parkPosition = park.ID
                WHERE carRegis like '$regis' AND tranOUT is null ";
                return $this->db->query($sql)->result_array();
        }

        public function get_transacByTID($TID)
        {
                $sql = "SELECT transaction.ID,transaction.carRegis,tranIN,tranOUT,keymanIN,keymanOUT,timepark,transaction.memID,carRegis,CONCAT(park.zone,park.number) as parkPosition,park.ID as IDP,price,pathin,pathout,member.memType
                FROM transaction
                LEFT JOIN park on transaction.parkPosition = park.ID
                LEFT JOIN member on transaction.memID = member.memID
                WHERE transaction.ID = '$TID' AND tranOUT is null ";
                return $this->db->query($sql)->result_array();
        }

        public function get_parkbyID($id)
        {
            $sql = "SELECT CONCAT(park.zone,park.number) as parkPosition FROM park WHERE ID = '$id'";
            $data = $this->db->query($sql)->result_array();
            return $data[0]["parkPosition"];
        }

        public function get_stateparking() {
          $sql = "SELECT park.ID,park.zone,park.number FROM park
          left join zonepriority on  park.zone = zonepriority.zone
          WHERE status = '1' and memtypeID = '0'
          order by zonepriority.priority, number";

          $data = $this->db->query($sql)->result_array();

          if (count($data) > 0) {
            return False;
          } else {
            return True;
          }
        }

        public function get_emptyparking($regis,$memtype)
        {
                $sql = "SELECT park.ID,memberID,CONCAT(park.zone,park.number) as parkPosition
                FROM membercar
                LEFT JOIN park on membercar.parkPosition = park.ID
                WHERE carRegistration like '%$regis%' and park.ID is not null";
                $checkmember = $this->db->query($sql)->result_array();

                $emptyparking = "";

                if (count($checkmember) > 0) {

                        $emptyparking = $checkmember[0]["ID"];

                } else {

                        $sql = "SELECT park.ID,park.zone,park.number FROM park
                        left join zonepriority on  park.zone = zonepriority.zone
                        WHERE status = '1' and memtypeID = '$memtype'
                        order by zonepriority.priority, number ";
                        $data = $this->db->query($sql)->result_array();


                        if (count($data) > 0) {
                          $emptyparking = $data[0]["ID"];

                          $this->db->where('ID', $emptyparking);

                          $var = array(
                                  'status' => 0
                          );

                          $this->db->update('park', $var);
                        }

                }



                return $emptyparking;
        }

        public function get_memberID($regis)
        {
                $sql = "SELECT membercar.*,member.memType,membertype.memtype as memDesc
                FROM membercar
                LEFT JOIN member on membercar.memberID = member.memID
                LEFT JOIN membertype on member.memType = membertype.ID
                WHERE carRegistration like '%$regis%'";
                return $this->db->query($sql)->result_array();

        }

        public function new_transaction($data)
        {
                $this->db->insert('transaction', $data);
        }

        public function get_perhour($membertype)
        {
            $sql = "select * from membertype where ID = '$membertype'";
            return $this->db->query($sql)->result_array();

        }

        public function update_transaction($tranid,$data)
        {
            $this->db->where('ID', $tranid);
            $this->db->update('transaction', $data);
        }

        public function update_park($id,$state)
        {
                $this->db->where('ID', $id);

                $var = array(
                        'status' => $state
                );

                $this->db->update('park', $var);
        }

}


?>

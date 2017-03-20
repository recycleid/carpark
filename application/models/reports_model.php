<?php

class reports_model extends CI_Model {


        public function get_income($date)
        {
                $sql = "select sum(price) as perday
                from `transaction`
                where tranOUT between '$date' and '$date 23:59:59'";
                $data = $this->db->query($sql)->result_array();

                if (count($data) > 0) {
                        if ($data[0]["perday"] == 0) {
                          return 0;
                        } else {
                          return $data[0]["perday"];
                        }
                } else {
                        return 0;
                }

        }

        public function get_parkStatus($status)
        {
                $sql = "select count(ID) as cc
                from park
                where `status` = '$status'";
                $data = $this->db->query($sql)->result_array();

                if (count($data) > 0) {
                        return $data[0]["cc"];
                } else {
                        return 0;
                }

        }

        public function get_parklist()
        {
                $sql = "select CONCAT(zone,number) as list
                from park
                where `status` = '1'
                LIMIT 5";
                return $this->db->query($sql)->result_array();

        }

        public function get_transaction()
        {
                $sql = "select dbTRAN.ID,`transaction`.carRegis,dbTRAN.tranIN, dbTRAN.IN , if(dbTRAN.IN = 'OUT',`transaction`.price,'') as price
                from (select ID,tranIN,'IN' from `transaction`
                                union
                                select ID,tranOUT,'OUT' from `transaction`

                                ) as dbTRAN
                                left join `transaction` on dbTRAN.ID = `transaction`.ID

                where dbTRAN.tranIN is not null
                order by tranIN desc
                LIMIT 5";
                return $this->db->query($sql)->result_array();

        }


}


?>

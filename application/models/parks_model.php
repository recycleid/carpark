<?php

class parks_model extends CI_Model {

        public function get_zone()
        {       
                $sql = "SELECT * FROM zone "; 
                return $this->db->query($sql)->result_array();
        }

        public function get_park()
        {       
                $sql = "SELECT * FROM park "; 
                return $this->db->query($sql)->result_array();
        }


        public function get_zoneByzone($zone)
        {       
                $sql = "SELECT * FROM zone WHERE zone like '$zone' "; 
                return $this->db->query($sql)->result_array();
        }

        public function new_Zone($data)
        {
                $this->db->insert('zone', $data);
        }

        public function getparkByzone($zone)
        {       
                $sql = "SELECT * FROM park WHERE zone like '$zone' ORDER BY number DESC "; 
                return $this->db->query($sql)->result_array();
        }

        public function new_Park($zone,$max,$number)
        {
                $nADD = 0;
                for ($i=1;$i<=$number;$i++) {
                        $nADD = $max+$i;


                        $var = array(
                                'zone' => $zone,
                                'number' => $nADD,
                                'status' => '1'
                        );

                        $this->db->insert('park', $var);

                }


        }

        public function edit_park($id,$state)
        {       
                $this->db->where('ID', $id);

                $var = array(
                        'status' => $state
                );

                $this->db->update('park', $var); 
        }


}


?>
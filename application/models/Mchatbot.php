<?php
class Mchatbot extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function get_responses($question = FALSE) {
        if ($question === FALSE) {
            $query = $this->db->get('chatbot');
            return $query->result_array();
        }
        
        $this->db->like('question', $question);
        $query = $this->db->get('chatbot');
        return $query->row_array();
    }
    
    public function set_response($data) {
        return $this->db->insert('chatbot', $data);
    }
    
    public function update_response($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('chatbot', $data);
    }
    
    public function delete_response($id) {
        $this->db->where('id', $id);
        return $this->db->delete('chatbot');
    }
}

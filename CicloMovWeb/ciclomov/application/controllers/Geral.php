<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Inicia sessão
session_start();

class Geral extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('view_header');
		$this->load->view('view_navbar');
		$this->load->view('view_login');
		$this->load->view('view_toast');
		$this->load->view('view_home');
		$this->load->view('view_footer');
	}

	public function pontos()
	{
		$this->load->model('Model_pontos');
		$pontos = $this->Model_pontos->selectPonto();
		
        foreach ($pontos as $n => $row) 
        { 
            $ponto[$n] = [
                'cod' => $row->cod_ponto,
                'vagasLivres' => $row->vagas_livres_ponto,
                'vagasTotais' => $row->vagas_totais_ponto,
                'descricao' => $row->descricao,
                'mapa' => $row->mapa
			];
        }

		$dados['pontos'] = $ponto;

		$this->load->helper('url');
		$this->load->view('view_header');
		$this->load->view('view_navbar');
		$this->load->view('view_login');
		$this->load->view('view_toast');
		$this->load->view('view_servico');
		$this->load->view('view_pontos', $dados);
		$this->load->view('view_footer');
	}
	
	public function sobre()
	{
		$this->load->helper('url');
		$this->load->view('view_header');
		$this->load->view('view_navbar');
		$this->load->view('view_login');
		$this->load->view('view_toast');
		$this->load->view('view_sobre');
		$this->load->view('view_footer');
	}

	public function login() 
	{
		$usuario = $this->input->post('usuario');
		$senha = $this->input->post('senha');
		
		$this->load->model('Model_login');
		$confirmacao = $this->Model_login->verificarLogin($usuario, $senha);

		if($confirmacao != 'erro') 
		{
			$SESSION['login'] = $confirmacao;
			$dados['erro'] = 0;
		}		
		else
		{
			$dados['erro'] = 1;
		}
		
		$this->load->helper('url');
		$this->load->view('view_header');
		$this->load->view('view_navbar', $dados);
		$this->load->view('view_toast');
		$this->load->view('view_login');
		$this->load->view('view_home', $dados);
		$this->load->view('view_footer', $dados);
	}

	//public function cadastrar() 
	// {

	// 	$nome = $this->input->post('nome');
	// 	$usuario2 = $this->input->post('usuario');
	// 	$email = $this->input->post('email');
	// 	$senha2 = $this->input->post('senha');

	// 	
	// }
}

package lanchonete.DAO;

import java.math.BigDecimal;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import lanchonete.model.ClienteDto;

public class ClienteDao {

	public List<ClienteDto> listarClientes() throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_clientes");
		// sql.append("WHERE nome_cliente LIKE ? ");
		// sql.append("ORDER BY nome_cliente ");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		// comando.setString(1, "%" + c.getNome()+ "%");

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();

		/* Cria uma lista para armazenar o resultado da consulta */
		List<ClienteDto> lista = new ArrayList<ClienteDto>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/* Cria um objeto para armazenar uma linha da consulta */
			ClienteDto cliente = new ClienteDto();
			cliente.setCodigoCliente(new BigDecimal(resultado.getInt("cod_cliente")));
			cliente.setNome(resultado.getString("nome_cliente"));
			cliente.setTelefone(resultado.getString("telefone_cliente"));
			cliente.setEndereco(resultado.getString("endereco_cliente"));
			cliente.setCpf(resultado.getString("cpf_cliente"));
			/* Armazena a linha lida em uma lista */
			lista.add(cliente);
		}

		/* Fecha a conexão */
		if (resultado != null) {
			resultado.close();
		}
		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}

		/* Retorna a lista contendo o resultado da consulta */
		return lista;
	}
	
	public ClienteDto getCliente(BigDecimal codCliente) throws Exception {
		
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"INSERT INTO tb_clientes(nome_cliente, telefone_cliente, cpf_cliente, endereco_cliente) VALUES (?,?,?,?)");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;
		ClienteDto cliente = new ClienteDto();

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setBigDecimal(1, codCliente);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		
		cliente.setCodigoCliente(new BigDecimal(resultado.getInt("cod_cliente")));
		cliente.setNome(resultado.getString("nome_cliente"));
		cliente.setTelefone(resultado.getString("telefone_cliente"));
		cliente.setEndereco(resultado.getString("endereco_cliente"));
		cliente.setCpf(resultado.getString("cpf_cliente"));
		
		
		if (resultado != null) {
			resultado.close();
		}
		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return cliente;
	}
	
	public boolean salvarCliente(ClienteDto c) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"INSERT INTO tb_clientes(nome_cliente, telefone_cliente, cpf_cliente, endereco_cliente) VALUES (?,?,?,?)");

		Connection conn = null;
		PreparedStatement ppst = null;
		boolean resultado = false;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, c.getNome());
		ppst.setString(2, c.getTelefone());
		ppst.setString(3, c.getCpf());
		ppst.setString(4, c.getEndereco());

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.execute();

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public boolean deletarCliente(BigDecimal codCliente) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("DELETE FROM tb_clientes WHERE cod_cliente = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		boolean resultado = false;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setBigDecimal(1, codCliente);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.execute();

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public boolean updateCliente(ClienteDto c) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"UPDATE tb_clientes SET nome_cliente = ?, telefone_cliente = ?, cpf_cliente = ?, endereco_cliente = ?"
				+ " WHERE cod_cliente = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		boolean resultado = false;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, c.getNome());
		ppst.setString(2, c.getTelefone());
		ppst.setString(3, c.getCpf());
		ppst.setString(4, c.getEndereco());
		ppst.setBigDecimal(5, c.getCodigoCliente());

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.execute();

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

}

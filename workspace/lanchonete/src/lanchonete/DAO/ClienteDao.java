package lanchonete.DAO;

import java.math.BigDecimal;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import lanchonete.model.ClienteModel;
import lanchonete.model.PedidoModel;
import lanchonete.model.ProdutoModel;

public class ClienteDao {

	PedidoDao pedidoDao = new PedidoDao();

	public List<ClienteModel> listarClientes() throws Exception {
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
		List<ClienteModel> lista = new ArrayList<ClienteModel>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/* Cria um objeto para armazenar uma linha da consulta */
			ClienteModel cliente = new ClienteModel();
			cliente.setCodigoCliente(new BigDecimal(resultado.getInt("cod_cliente")));
			cliente.setNome(resultado.getString("nome_cliente"));
			cliente.setTelefone(resultado.getString("telefone_cliente"));
			cliente.setEndereco(resultado.getString("endereco_cliente"));
			cliente.setCpf(resultado.getBigDecimal("cpf_cliente"));
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

	public ClienteModel getCliente(BigDecimal codCliente) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_clientes WHERE cod_cliente = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;
		ClienteModel cliente = new ClienteModel();

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setBigDecimal(1, codCliente);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		while (resultado.next()) {
			cliente.setCodigoCliente(new BigDecimal(resultado.getInt("cod_cliente")));
			cliente.setNome(resultado.getString("nome_cliente"));
			cliente.setTelefone(resultado.getString("telefone_cliente"));
			cliente.setEndereco(resultado.getString("endereco_cliente"));
			cliente.setCpf(resultado.getBigDecimal("cpf_cliente"));
		}
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

	public int salvarCliente(ClienteModel c) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"INSERT INTO tb_clientes(nome_cliente, telefone_cliente, cpf_cliente, endereco_cliente) VALUES (?,?,?,?)");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, c.getNome());
		ppst.setString(2, c.getTelefone());
		ppst.setBigDecimal(3, c.getCpf());
		ppst.setString(4, c.getEndereco());

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeUpdate();

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public int deletarCliente(BigDecimal codCliente) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("DELETE FROM tb_clientes WHERE cod_cliente = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setBigDecimal(1, codCliente);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeUpdate();

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public int updateCliente(ClienteModel c) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"UPDATE tb_clientes SET nome_cliente = ?, telefone_cliente = ?, cpf_cliente = ?, endereco_cliente = ?"
						+ " WHERE cod_cliente = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, c.getNome());
		ppst.setString(2, c.getTelefone());
		ppst.setBigDecimal(3, c.getCpf());
		ppst.setString(4, c.getEndereco());
		ppst.setBigDecimal(5, c.getCodigoCliente());

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeUpdate();

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public List<PedidoModel> getHistoricoCliente(BigDecimal codCliente) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();

		sql.append("SELECT t1.*, t2.nome_cliente,t2.telefone_cliente,t2.cpf_cliente,t2.endereco_cliente"
				+ " FROM tb_pedidos t1" + " INNER JOIN tb_clientes t2 ON (t1.cod_cliente = t2.cod_cliente)"
				+ " WHERE t1.cod_cliente = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setBigDecimal(1, codCliente);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();

		/* Cria uma lista para armazenar o resultado da consulta */
		List<PedidoModel> lista = new ArrayList<PedidoModel>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/*
			 * Chama o Dao dos pedidos para buscar os itens do pedido que esta
			 * sendo preenchido neste loop
			 */
			List<ProdutoModel> listProdutos = pedidoDao.getProdutosPedido(resultado.getBigDecimal(1));
			/* Cria um objeto para armazenar uma linha da consulta */
			PedidoModel pedido = new PedidoModel();
			ClienteModel cliente = new ClienteModel();
			// Populando dados do pedido
			pedido.setCod_pedido(resultado.getInt(1));
			pedido.setData_pedido(resultado.getDate(4));
			pedido.setStatus_pedido(resultado.getInt(5));
			pedido.setTotal(resultado.getBigDecimal(3));
			// Populando dados do cliente
			cliente.setCodigoCliente(resultado.getBigDecimal(1));
			cliente.setCpf(resultado.getBigDecimal(8));
			cliente.setEndereco(resultado.getString(9));
			cliente.setNome(resultado.getString(6));
			cliente.setTelefone(resultado.getString(7));
			// Colocando o objeto cliente dentro do pedido
			pedido.setCliente(cliente);
			// Colocando a lista de produtos no pedido
			pedido.setProdutos(listProdutos);
			// Colocando o objeto pedido dentro da lista de pedidos que sera
			// retornada
			lista.add(pedido);
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
}

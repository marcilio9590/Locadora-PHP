package lanchonete.DAO;

import java.math.BigDecimal;
import java.sql.BatchUpdateException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import lanchonete.model.ClienteModel;
import lanchonete.model.PedidoModel;
import lanchonete.model.ProdutoModel;

public class PedidoDao {

	public List<ProdutoModel> getProdutosPedido(BigDecimal codPedido) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"SELECT t1.*,t2.* FROM tb_itens_pedido t1 INNER JOIN tb_estoque t2 ON (t1.cod_produto = t2.cod_produto) WHERE t1.cod_pedido = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;
		List<ProdutoModel> listProdutos = new ArrayList<ProdutoModel>();

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setBigDecimal(1, codPedido);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		while (resultado.next()) {
			ProdutoModel p = new ProdutoModel();
			p.setIdItemPedido(resultado.getInt("id"));
			p.setCod_produto(resultado.getInt("cod_produto"));
			p.setCod_pedido(resultado.getInt("cod_pedido"));
			p.setNome_produto(resultado.getString("nome_produto"));
			p.setPreco_produto(resultado.getBigDecimal("preco_produto"));
			p.setQuantidade(resultado.getInt("quantidade"));
			p.setData_validade(resultado.getDate("data_validade"));
			p.setCod_produto(resultado.getInt("cod_produto"));
			listProdutos.add(p);
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
		return listProdutos;
	}

	public PedidoModel getPedido(int codPedido) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();

		sql.append("SELECT t1.*, t2.nome_cliente,t2.telefone_cliente,t2.cpf_cliente,t2.endereco_cliente"
				+ " FROM tb_pedidos t1" + " INNER JOIN tb_clientes t2 ON (t1.cod_cliente = t2.cod_cliente)"
				+ " WHERE t1.cod_pedido = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, codPedido);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		PedidoModel pedido = new PedidoModel();
		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/*
			 * Chama o Dao dos pedidos para buscar os itens do pedido que esta
			 * sendo preenchido neste loop
			 */
			List<ProdutoModel> listProdutos = getProdutosPedido(resultado.getBigDecimal(1));
			/* Cria um objeto para armazenar uma linha da consulta */
			ClienteModel cliente = new ClienteModel();
			// Populando dados do pedido
			pedido.setCod_pedido(resultado.getInt(1));
			pedido.setData_pedido(resultado.getDate(4));
			pedido.setStatus_pedido(resultado.getInt(5));
			pedido.setCod_mesa(resultado.getInt(6));
			pedido.setTotal(resultado.getBigDecimal(3));
			// Populando dados do cliente
			cliente.setCodigoCliente(resultado.getBigDecimal(2));
			cliente.setCpf(resultado.getBigDecimal(9));
			cliente.setEndereco(resultado.getString(10));
			cliente.setNome(resultado.getString(7));
			cliente.setTelefone(resultado.getString(8));
			// Colocando o objeto cliente dentro do pedido
			pedido.setCliente(cliente);
			// Colocando a lista de produtos no pedido
			pedido.setProdutos(listProdutos);
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
		return pedido;
	}

	public int realizarPedido(PedidoModel pedido) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		StringBuilder sql2 = new StringBuilder();
		sql.append("INSERT INTO tb_pedidos(cod_cliente, total, data, status, cod_mesa) VALUES (?,?,?,?,?);");
		sql2.append("SELECT LAST_INSERT_ID();");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString(), Statement.RETURN_GENERATED_KEYS);
		ppst.setBigDecimal(1, pedido.getCliente().getCodigoCliente());
		ppst.setBigDecimal(2, calcularTotal(pedido.getProdutos()));
		java.util.Date data = new java.util.Date();
		java.sql.Date dataSql = new java.sql.Date(data.getTime());
		ppst.setDate(3, dataSql);
		ppst.setInt(4, 1);
		ppst.setInt(5, pedido.getCod_mesa());

		/* Executa a SQL e captura o resultado da consulta */
		int resultadoPedido = ppst.executeUpdate();
		if (resultadoPedido == 1) {
			ppst = conn.prepareStatement(sql2.toString());
			ResultSet resultadoNumPedido = ppst.executeQuery();
			while (resultadoNumPedido.next()) {
				int countItemPedido = salvarItensPedido(pedido.getProdutos(), resultadoNumPedido.getInt(1));
				if (countItemPedido == 1) {
					resultado = resultadoNumPedido.getInt(1);
				}
			}
			if (resultadoNumPedido != null) {
				resultadoNumPedido.close();
			}
		}
		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	private BigDecimal calcularTotal(List<ProdutoModel> list) {
		BigDecimal total = new BigDecimal("0");
		for (ProdutoModel p : list) {
			total = total.add(p.getPreco_produto().multiply(new BigDecimal(p.getQuantidade())));
		}
		return total;
	}

	public int salvarItensPedido(List<ProdutoModel> itens, int codPedido) throws Exception {

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		conn = Conexao.abrir();
		try {
			StringBuilder sql = new StringBuilder();
			sql.append("INSERT INTO tb_itens_pedido(cod_produto, quantidade, cod_pedido) VALUES (?,?,?)");
			Iterator<ProdutoModel> it = itens.iterator();
			ppst = conn.prepareStatement(sql.toString());
			while (it.hasNext()) {
				ProdutoModel p = it.next();
				ppst.setInt(1, p.getCod_produto());
				ppst.setInt(2, p.getQuantidade());
				ppst.setInt(3, codPedido);
				ppst.addBatch();
			}
			int[] numUpdates = ppst.executeBatch();
			if (numUpdates.length == itens.size()) {
				resultado = 1;
			}
		} catch (BatchUpdateException b) {
			System.out.println(b.toString());
		}

		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public int encerrarPedido(int codPedido) throws Exception {
		// define a SQL
		StringBuilder sql = new StringBuilder();
		sql.append("UPDATE tb_pedidos SET status = ? WHERE cod_pedido = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, 3);
		ppst.setInt(2, codPedido);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeUpdate();

		/* Fecha a conexão */
		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public int excluirPedido(int codPedido) throws Exception {
		int deletItens = excluirItensPedido(codPedido);
		int resultado = 0;
		if (deletItens > 0) {
			// define a SQL
			StringBuilder sql = new StringBuilder();
			sql.append("DELETE FROM tb_pedidos WHERE cod_pedido = ?");

			Connection conn = null;
			PreparedStatement ppst = null;

			/*
			 * Abre a conexão que criamos o retorno é armazenado na variavel
			 * conn
			 */
			conn = Conexao.abrir();

			/* Mapeamento objeto relacional */
			ppst = conn.prepareStatement(sql.toString());
			ppst.setInt(1, codPedido);

			/* Executa a SQL e captura o resultado da consulta */
			resultado = ppst.executeUpdate();

			/* Fecha a conexão */
			if (ppst != null) {
				ppst.close();
			}
			if (conn != null) {
				conn.close();
			}
		}
		return resultado;
	}

	public int excluirItensPedido(int codPedido) throws Exception {
		// define a SQL
		StringBuilder sql = new StringBuilder();
		sql.append("DELETE FROM tb_itens_pedido WHERE cod_pedido = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, codPedido);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeUpdate();

		/* Fecha a conexão */
		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return resultado;
	}

	public List<PedidoModel> listarPedidos() throws Exception{
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();

		sql.append("SELECT t1.*, t2.nome_cliente,t2.telefone_cliente,t2.cpf_cliente,t2.endereco_cliente"
				+ " FROM tb_pedidos t1" + " INNER JOIN tb_clientes t2 ON (t1.cod_cliente = t2.cod_cliente)");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		List<PedidoModel> pedidos = new ArrayList<PedidoModel>();
		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			//cria o objeto pedido para setar o pedido e depois adicionar na lista
			PedidoModel pedido = new PedidoModel();
			/*
			 * Chama o Dao dos pedidos para buscar os itens do pedido que esta
			 * sendo preenchido neste loop
			 */
			List<ProdutoModel> listProdutos = getProdutosPedido(resultado.getBigDecimal(1));
			/* Cria um objeto para armazenar uma linha da consulta */
			ClienteModel cliente = new ClienteModel();
			// Populando dados do pedido
			pedido.setCod_pedido(resultado.getInt(1));
			pedido.setData_pedido(resultado.getDate(4));
			pedido.setStatus_pedido(resultado.getInt(5));
			pedido.setCod_mesa(resultado.getInt(6));
			pedido.setTotal(resultado.getBigDecimal(3));
			// Populando dados do cliente
			cliente.setCodigoCliente(resultado.getBigDecimal(2));
			cliente.setCpf(resultado.getBigDecimal(9));
			cliente.setEndereco(resultado.getString(10));
			cliente.setNome(resultado.getString(7));
			cliente.setTelefone(resultado.getString(8));
			// Colocando o objeto cliente dentro do pedido
			pedido.setCliente(cliente);
			// Colocando a lista de produtos no pedido
			pedido.setProdutos(listProdutos);
			
			pedidos.add(pedido);
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
		return pedidos;
	}
}













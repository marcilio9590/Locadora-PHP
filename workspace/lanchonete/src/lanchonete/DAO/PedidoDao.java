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

public class PedidoDao {
	
	public List<ProdutoModel> getProdutosPedido(BigDecimal codPedido) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT t1.*,t2.* FROM tb_itens_pedido t1 INNER JOIN tb_estoque t2 ON (t1.cod_produto = t2.cod_produto) WHERE t1.cod_pedido = ?");
		
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
		while(resultado.next()){
			ProdutoModel p = new ProdutoModel();
			p.setIdItemPedido(resultado.getInt("id"));
			p.setCod_produto(resultado.getInt("cod_produto"));
			p.setCod_pedido(resultado.getInt("cod_pedido"));
			p.setNome_produto(resultado.getString("nome_produto"));
			p.setPreco_produto(resultado.getBigDecimal("preco_produto"));
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
	
	public PedidoModel getPedido(int codPedido) throws Exception{
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
}

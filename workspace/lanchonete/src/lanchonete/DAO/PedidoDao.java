package lanchonete.DAO;

import java.math.BigDecimal;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

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
	
}

package lanchonete.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import lanchonete.model.ProdutoModel;

public class EstoqueDao {

	public int salvarProduto(ProdutoModel p) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"INSERT INTO tb_estoque(nome_produto, preco_produto, data_validade, qtd_disponivel) VALUES (?,?,?,?)");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, p.getNome_produto());
		ppst.setBigDecimal(2, p.getPreco_produto());
		ppst.setDate(3, new java.sql.Date(p.getData_validade().getTime()));
		ppst.setInt(4, p.getQtd_disponivel());

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

	public List<ProdutoModel> listarProdutos() throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_estoque");

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
		List<ProdutoModel> lista = new ArrayList<ProdutoModel>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/* Cria um objeto para armazenar uma linha da consulta */
			ProdutoModel p = new ProdutoModel();
			p.setCod_produto(resultado.getInt(5));
			p.setNome_produto(resultado.getString(1));
			p.setPreco_produto(resultado.getBigDecimal(2));
			p.setData_validade(resultado.getDate(3));
			p.setQtd_disponivel(resultado.getInt(4));
			/* Armazena a linha lida em uma lista */
			lista.add(p);
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

	public ProdutoModel getProduto(int codProduto) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_estoque WHERE cod_produto = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;
		ProdutoModel p = new ProdutoModel();

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, codProduto);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		while (resultado.next()) {
			p.setCod_produto(resultado.getInt(5));
			p.setData_validade(resultado.getDate(3));
			p.setNome_produto(resultado.getString(1));
			p.setPreco_produto(resultado.getBigDecimal(2));
			p.setQtd_disponivel(resultado.getInt(4));
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
		return p;
	}

	public int updateProduto(ProdutoModel p) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("UPDATE tb_estoque SET nome_produto = ?, preco_produto = ?, data_validade = ?, qtd_disponivel = ?"
				+ " WHERE cod_produto = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, p.getNome_produto());
		ppst.setBigDecimal(2, p.getPreco_produto());
		ppst.setDate(3, new java.sql.Date(p.getData_validade().getTime()));
		ppst.setInt(4, p.getQtd_disponivel());
		ppst.setInt(5, p.getCod_produto());

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

	public int deletarProduto(int codProd) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("DELETE FROM tb_estoque WHERE cod_produto = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, codProd);

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

	/**
	 * 
	 * @param nivel
	 * @return
	 * @throws Exception
	 */
	public List<ProdutoModel> checarNivelEstoque(int nivel) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_estoque WHERE qtd_disponivel <= ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, nivel);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();

		/* Cria uma lista para armazenar o resultado da consulta */
		List<ProdutoModel> lista = new ArrayList<ProdutoModel>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/* Cria um objeto para armazenar uma linha da consulta */
			ProdutoModel p = new ProdutoModel();
			p.setCod_produto(resultado.getInt(5));
			p.setNome_produto(resultado.getString(1));
			p.setPreco_produto(resultado.getBigDecimal(2));
			p.setData_validade(resultado.getDate(3));
			p.setQtd_disponivel(resultado.getInt(4));
			/* Armazena a linha lida em uma lista */
			lista.add(p);
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

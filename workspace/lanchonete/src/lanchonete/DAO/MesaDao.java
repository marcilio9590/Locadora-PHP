package lanchonete.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import lanchonete.model.MesaModel;


public class MesaDao {

	public List<MesaModel> listarMesas() throws Exception {

		// define a SQL
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_mesas");
		
		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();

		/* Cria uma lista para armazenar o resultado da consulta */
		List<MesaModel> lista = new ArrayList<MesaModel>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/* Cria um objeto para armazenar uma linha da consulta */
			MesaModel mesa = new MesaModel();
			mesa.setCod_mesa(resultado.getInt("cod_mesa"));
			mesa.setStatus(resultado.getString("status"));

			/* Armazena a linha lida em uma lista */
			lista.add(mesa);
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

	public MesaModel getMesa(int cod_mesa) throws Exception{
	    	/* Define a SQL */
			StringBuilder sql = new StringBuilder();
			sql.append("SELECT * FROM tb_mesas WHERE cod_mesa = ?");
			
			Connection conn = null;
			PreparedStatement ppst = null;
			ResultSet resultado = null;
			MesaModel mesa = new MesaModel();
			
			/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
			conn = Conexao.abrir();
			
			/* Mapeamento objeto relacional */
			ppst = conn.prepareStatement(sql.toString());
			ppst.setInt(1, cod_mesa);

			/* Executa a SQL e captura o resultado da consulta */
			resultado = ppst.executeQuery();
			while(resultado.next()){
				mesa.setCod_mesa(resultado.getInt("cod_mesa"));
			    mesa.setStatus(resultado.getString("status"));
			   
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
			return mesa;		
			}

	public int cadastrarMesa(MesaModel m) throws Exception {

		// define a SQL
		StringBuilder sql = new StringBuilder();
		sql.append("INSERT INTO tb_mesas(status) VALUES (?)");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1,"Livre");

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

	public int deletarMesa(int cod_mesa) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("DELETE FROM tb_mesas WHERE cod_mesa = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, cod_mesa);

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

	public int updateMesa(MesaModel m) throws Exception {


		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("UPDATE tb_mesas SET status = ?" + " WHERE cod_mesa = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, m.getStatus());
		ppst.setInt(2, m.getCod_mesa());
		
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
}
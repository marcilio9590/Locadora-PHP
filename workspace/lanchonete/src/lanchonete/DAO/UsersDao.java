package lanchonete.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import lanchonete.model.UsuarioModel;

public class UsersDao {
	
	public int setLimiteAviso(int nivel, int cod_user) throws Exception {
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"UPDATE tb_users SET qtd_alerta_nivel_estoque = ? WHERE cod_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, nivel);
		ppst.setInt(2, cod_user);

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
	
	public int saveUser(UsuarioModel user) throws Exception{
		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append(
				"INSERT INTO tb_users(nome_user, cpf_user, login_user, perfil_user, senha_user) VALUES (?,?,?,?,?)");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, user.getNome_user());
		ppst.setString(2, user.getCpf_user());
		ppst.setString(3, user.getLogin_user());
		ppst.setInt(4, user.getPerfil_user());
		ppst.setString(5, user.getLogin_user());

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

	public int deletarUser(int cod_user) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("DELETE FROM tb_users WHERE cod_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, cod_user);

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

	public int updateUser(UsuarioModel m) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("UPDATE tb_users SET nome_user = ?, cpf_user = ?, login_user = ?, perfil_user = ? WHERE cod_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, m.getNome_user());
		ppst.setString(2, m.getCpf_user());
		ppst.setString(3, m.getLogin_user());
		ppst.setInt(4, m.getPerfil_user());
		ppst.setInt(5, m.getCod_user());
		
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

	public List<UsuarioModel> listarUsuarios() throws Exception {

		// define a SQL
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_users");
		
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
		List<UsuarioModel> lista = new ArrayList<UsuarioModel>();

		/* Percorre o resultado armazenando os valores em uma lista */
		while (resultado.next()) {
			/* Cria um objeto para armazenar uma linha da consulta */
			UsuarioModel user = new UsuarioModel();
			user.setCod_user(resultado.getInt(6));
			user.setCpf_user(resultado.getString(2));
			user.setLogin_user(resultado.getString(3));
			user.setNome_user(resultado.getString(1));
			user.setPerfil_user(resultado.getInt(5));
			user.setQtd_alerta_estoque(resultado.getInt(7));

			/* Armazena a linha lida em uma lista */
			lista.add(user);
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
	
	public int trocarPerfil(int codUser, int novoPerfil) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("UPDATE tb_users SET perfil_user = ? WHERE cod_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, novoPerfil);
		ppst.setInt(2, codUser);
		
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
	
	public int trocarSenha(int codUser, int novaSenha) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("UPDATE tb_users SET senha_user = ? WHERE cod_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		int resultado = 0;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, novaSenha);
		ppst.setInt(2, codUser);
		
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

	public UsuarioModel getUser(int codUser) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_users WHERE cod_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		UsuarioModel user = new UsuarioModel();
		ResultSet resultado = null;

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setInt(1, codUser);
		
		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		while(resultado.next()){
			user.setCod_user(resultado.getInt(6));
			user.setCpf_user(resultado.getString(2));
			user.setLogin_user(resultado.getString(3));
			user.setNome_user(resultado.getString(1));
			user.setPerfil_user(resultado.getInt(5));
			user.setQtd_alerta_estoque(resultado.getInt(7));
		}

		/* Fecha a conexão */
		if (ppst != null) {
			ppst.close();
		}
		if (conn != null) {
			conn.close();
		}
		return user;

	}

	
}

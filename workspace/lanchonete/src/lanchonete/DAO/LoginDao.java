package lanchonete.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import lanchonete.model.UsuarioModel;

public class LoginDao {
	public UsuarioModel realizarLogin(String user, String pass) throws Exception {

		/* Define a SQL */
		StringBuilder sql = new StringBuilder();
		sql.append("SELECT * FROM tb_users WHERE login_user = ? AND senha_user = ?");

		Connection conn = null;
		PreparedStatement ppst = null;
		ResultSet resultado = null;
		UsuarioModel usuario = new UsuarioModel();

		/* Abre a conexão que criamos o retorno é armazenado na variavel conn */
		conn = Conexao.abrir();

		/* Mapeamento objeto relacional */
		ppst = conn.prepareStatement(sql.toString());
		ppst.setString(1, user);
		ppst.setString(2, pass);

		/* Executa a SQL e captura o resultado da consulta */
		resultado = ppst.executeQuery();
		while (resultado.next()) {
			usuario.setCod_user(resultado.getInt(6));
			usuario.setCpf_user(resultado.getString(2));
			usuario.setLogin_user(resultado.getString(3));
			usuario.setNome_user(resultado.getString(1));
			usuario.setPerfil_user(resultado.getInt(5));
			usuario.setPerfil_user(resultado.getInt(5));
			usuario.setQtd_alerta_estoque(resultado.getInt(7));
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
		return usuario;
	}
}

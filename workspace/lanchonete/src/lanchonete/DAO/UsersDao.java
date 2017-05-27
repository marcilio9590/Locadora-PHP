package lanchonete.DAO;

import java.sql.Connection;
import java.sql.PreparedStatement;

public class UsersDao {
	
	/**
	 * 
	 * @param nivel
	 * @param cod_user
	 * @return
	 * @throws Exception
	 */
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
	
}

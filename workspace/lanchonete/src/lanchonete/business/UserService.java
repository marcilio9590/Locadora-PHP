package lanchonete.business;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

import lanchonete.DAO.UsersDao;
import lanchonete.model.UsuarioModel;
import lanchonete.view.UsuarioView;

public class UserService {
	
	UsersDao dao = new UsersDao();
	
	public int setLimiteAviso(int nivel, int cod_user) {
		int retorno = 0;
		try {
			retorno = dao.setLimiteAviso(nivel, cod_user);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int salvarUsuario(UsuarioModel user) {
		int retorno = 0;
		try {
			retorno = dao.saveUser(user);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int excluirUsuario(int cod_user) {
		int retorno = 0;
		try {
			retorno = dao.deletarUser(cod_user);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

	public int editarUsuario(UsuarioModel user) {
		int retorno = 0;
		try {
			retorno = dao.updateUser(user);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int trocarPerfil(int codUser, int novoPerfil) {
		int retorno = 0;
		try {
			retorno = dao.trocarPerfil(codUser, novoPerfil);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int trocarSenha(int codUser, int novaSenha) {
		int retorno = 0;
		try {
			retorno = dao.trocarSenha(codUser, novaSenha);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public void listarUsuarios() {
		try {
			List<UsuarioModel> lista = dao.listarUsuarios();
			if (!lista.isEmpty()) {
				UsuarioView usuarioView = new UsuarioView();
				usuarioView.listarUsuarios(lista);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	public List<UsuarioModel> getUsuario(int codUsuario) {
		List<UsuarioModel> lista = new ArrayList<>();
		try {
			UsuarioModel p = dao.getUser(codUsuario);
			if (new BigDecimal(p.getCod_user()) != null) {
				lista.add(p);
			}

		} catch (Exception e) {
			e.printStackTrace();
		}
		return lista;
	}

}

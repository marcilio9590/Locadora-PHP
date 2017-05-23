package lanchonete.business;

import lanchonete.DAO.LoginDao;
import lanchonete.model.UsuarioModel;

public class LoginService {

	public UsuarioModel realizarLogin(String login, String pass) {
		LoginDao dao = new LoginDao();
		UsuarioModel user = new UsuarioModel();
		try {
			user = dao.realizarLogin(login, pass);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return user;
	}

}

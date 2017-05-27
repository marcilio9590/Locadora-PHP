package lanchonete.business;

import lanchonete.DAO.UsersDao;

public class UserService {

	public int setLimiteAviso(int nivel, int cod_user) {
		UsersDao dao = new UsersDao();
		int retorno = 0;
		try {
			retorno = dao.setLimiteAviso(nivel, cod_user);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}

}

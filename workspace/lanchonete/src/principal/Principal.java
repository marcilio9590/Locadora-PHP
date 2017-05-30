/**
 * 
 */
package principal;

import lanchonete.model.UsuarioModel;
import lanchonete.view.LoginView;
import lanchonete.view.MenuView;

/**
 * @author Marcilio
 *
 */
public class Principal {
	
	/**
	 * @param args
	 * @throws Exception 
	 */
	public static void main(String[] args) throws Exception {
		boolean flagLogin = true;
		LoginView loginView = new LoginView();
		do {
			UsuarioModel user = loginView.login();
			if (user.getNome_user() == null) {
				System.out.println("Dados Incorretos");
				System.out.println("");
			} else {
				flagLogin = false;
				MenuView menuProprietario = new MenuView();
				menuProprietario.menu(user);
			}
		} while (flagLogin);
	}
}

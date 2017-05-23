/**
 * 
 */
package principal;

import java.io.IOException;

import lanchonete.model.UsuarioModel;
import lanchonete.view.LoginView;
import lanchonete.view.MenuProprietarioView;

/**
 * @author Marcilio
 *
 */
public class Principal {

	/**
	 * @param args
	 */
	public static void main(String[] args) throws IOException {
		boolean flagLogin = true;
		LoginView loginView = new LoginView();
		do {
			UsuarioModel user = loginView.login();
			if (user.getNome_user() == null) {
				System.out.println("Dados Incorretos");
				System.out.println("");
			} else {
				flagLogin = false;
				MenuProprietarioView menuProprietario = new MenuProprietarioView();
				menuProprietario.menu(user.getPerfil_user());
			}
		} while (flagLogin);
	}
}

/**
 * 
 */
package principal;

import java.io.IOException;
import java.text.ParseException;

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
	 * @throws ParseException 
	 */
	public static void main(String[] args) throws IOException, ParseException {
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

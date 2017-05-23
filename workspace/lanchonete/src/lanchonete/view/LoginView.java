package lanchonete.view;

import java.util.Scanner;

import lanchonete.business.LoginService;
import lanchonete.model.UsuarioModel;

public class LoginView {
	private Scanner sc = new Scanner(System.in);

	public UsuarioModel login() {
		System.out.println("Digite o login: ");
		String login = sc.nextLine();
		System.out.println("Digite a senha: ");
		String senha = sc.nextLine();

		LoginService loginService = new LoginService();
		UsuarioModel user = loginService.realizarLogin(login, senha);

		return user;
	}

}

package lanchonete.view;

import java.util.List;

import lanchonete.model.UsuarioModel;

public class UsuarioView {
	public void listarUsuarios(List<UsuarioModel> lista) {
		System.out.println(
				"---------------------------------------- Lista de Usuários -------------------------------------");
		if(!lista.isEmpty()) {
			for (int i = 0; i < lista.size(); i++) {
				System.out.println("Código: " + lista.get(i).getCod_user());
				System.out.print("Perfil: "); System.out.println(lista.get(i).getPerfil_user() == 1 ? "Proprietário" : "Funcionário"); 
				System.out.println("Nome: " + lista.get(i).getNome_user());
				
				System.out.println("CPF: " + lista.get(i).getCpf_user());
				System.out.println("Login: " + lista.get(i).getLogin_user());
				System.out.println("Nível alerta de estoque: " + lista.get(i).getQtd_alerta_estoque());
				if (i != lista.size() - 1) {
					System.out.println(
							"------------------------------------------------------------------------------------------------");
				}
			}
		} else {
			System.out.println("Nenhum usuários encontrado.");
		}
		System.out.println(
				"------------------------------------------------------------------------------------------------");

	}
}	

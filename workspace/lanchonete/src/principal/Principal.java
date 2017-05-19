/**
 * 
 */
package principal;

import java.io.Console;
import java.io.IOException;
import java.util.Scanner;

import lanchonete.business.ClienteService;

/**
 * @author Marcilio
 *
 */
public class Principal {

	/**
	 * @param args
	 */
	private static ClienteService clienteService = new ClienteService();

	public static void main(String[] args) throws IOException {
		int opcao = 0;
		Scanner sc = new Scanner(System.in);
		do {
			System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
			System.out.println("\n                  =========================================");
			System.out.println("                  |     1 - Realizar Pedido         	  |");
			System.out.println("                  |     2 - Gerenciar Estoque             |");
			System.out.println("                  |     3 - Gerenciar Clientes            |");
			System.out.println("                  |     4 - Gerenciamento de Usuários     |");
			System.out.println("                  |     5 - Gerenciamento de Mesas        |");
			System.out.println("                  |     0 - Sair                          |");
			System.out.println("                  =========================================\n");
			opcao = sc.nextInt();
			switch (opcao) {
			case 3:
				getSubmenu(3);
				break;
			default:
				limpartela();
				System.out.println("Opção inválida!");
			}

		} while (opcao != 0);

	}

	private static void getSubmenu(int i) {
		int opcao = 0;
		do {
			switch (i) {
			case 1:

				break;
			case 2:

				break;
			case 3:
				System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
				System.out.println("\n                  =========================================");
				System.out.println("                  |     1 - Cadastrar Cliente         	  	|");
				System.out.println("                  |     2 - Listar Clientes             	|");
				System.out.println("                  |     3 - Editar Cliente           		|");
				System.out.println("                  |     4 - Excluir Cliente     			|");
				System.out.println("                  |     5 - Exibir Cliente     			    |");
				System.out.println("                  |     0 - Sair                        	|");
				System.out.println("                  =========================================\n");
				Scanner sc = new Scanner(System.in);
				opcao = sc.nextInt();
				switch (opcao) {
				case 1:

					break;
				case 2:
					clienteService.listarCliente();
					break;
				case 3:

					break;
				case 4:

					break;
				case 5:
					System.out.println("Digite o código do cliente: ");
					clienteService.getCliente(sc.nextBigDecimal());
					break;

				default:
					limpartela();
					System.out.println("Opção inválida!");
					break;
				}

				break;
			case 4:

				break;
			case 5:

				break;
			}
		} while (opcao != 0);
	}

	public static void limpartela() {
		for (int i = 0; i < 50; ++i)
			System.out.println();
	}

}

/**
 * 
 */
package principal;

import java.io.IOException;
import java.math.BigDecimal;
import java.util.List;
import java.util.Scanner;

import lanchonete.business.ClienteService;
import lanchonete.model.ClienteModel;
import lanchonete.model.PedidoModel;
import lanchonete.view.ClienteView;

/**
 * @author Marcilio
 *
 */
public class Principal {

	/**
	 * @param args
	 */
	private static ClienteService clienteService = new ClienteService();
	private static Scanner sc = new Scanner(System.in);

	public static void main(String[] args) throws IOException {
		int opcao = 0;
		// Menu principal onde o usuário pode acessar os submenus
		do {
			System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
			System.out.println("\n                  =========================================");
			System.out.println("                  |     1 - Realizar Pedido         	  |");
			System.out.println("                  |     2 - Gerenciamento de Estoque      |");
			System.out.println("                  |     3 - Gerenciamento de Clientes     |");
			System.out.println("                  |     4 - Gerenciamento de Usuários     |");
			System.out.println("                  |     5 - Gerenciamento de Mesas        |");
			System.out.println("                  |     0 - Sair                          |");
			System.out.println("                  =========================================\n");
			opcao = sc.nextInt();
			switch (opcao) {
			case 1:

				break;
			case 2:

				break;
			case 3:
				getSubmenu(3);
				break;
			case 4:

				break;
			case 5:

				break;
			case 0:
				break;
			default:
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
				MenuCliente();
				opcao = sc.nextInt();
				switch (opcao) {
				case 1:
					ClienteModel clienteCad = getDadosCliente();
					int returnSave = clienteService.salvarCliente(clienteCad);
					if (returnSave > 0) {
						System.out.println("Cliente Cadastrado com sucesso!!!");
					} else {
						System.out.println("Erro ao salvar cliente...");
					}
					break;
				case 2:
					clienteService.listarCliente();
					break;
				case 3:
					List<ClienteModel> listaUpdate;
					System.out.println("Digite o código do cliente: ");
					BigDecimal codCliente = sc.nextBigDecimal();
					listaUpdate = clienteService.getCliente(codCliente);
					if (listaUpdate.size() > 0) {
						ClienteModel c = getDadosCliente();
						c.setCodigoCliente(codCliente);
						int returnUpdate = clienteService.editarCliente(c);
						if (returnUpdate > 0) {
							System.out.println("Cliente editado com sucesso!!!");
						} else {
							System.out.println("Erro ao editar cliente...");
						}
					} else {
						System.out.println("Código inválido");
					}
					break;
				case 4:
					System.out.println("Digite o código do cliente: ");
					int returnDelete = clienteService.excluirCliente(sc.nextBigDecimal());
					if (returnDelete > 0) {
						System.out.println("Cliente excluído com sucesso!!!");
					} else {
						System.out.println("Erro ao excluir cliente...");
					}
					break;
				case 5:
					System.out.println("Digite o código do cliente: ");
					List<ClienteModel> listaCliente = clienteService.getCliente(sc.nextBigDecimal());
					if (listaCliente.size() > 0) {
						ClienteView clienteView = new ClienteView();
						clienteView.listarCliente(listaCliente);
					}
					break;
				case 6:
					System.out.println("Digite o código do cliente: ");
					List<PedidoModel> listPedidosCliente = clienteService.buscarHistoricoPedidosCliente(sc.nextBigDecimal());
					if (listPedidosCliente.size() > 0) {
						ClienteView clienteView = new ClienteView();
						clienteView.listarPedidosCliente(listPedidosCliente);
					}else{
						System.out.println("Nenhum pedido encontrado");
					}
					break;
				case 0:
					break;
				default:
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

	private static ClienteModel getDadosCliente() {
		ClienteModel clienteCad = new ClienteModel();
		System.out.println("Digite o nome: ");
		sc.nextLine();
		String nome = sc.nextLine();
		clienteCad.setNome(nome);
		System.out.println("Digite o CPF: ");
		BigDecimal cpf = new BigDecimal(sc.nextLong());
		clienteCad.setCpf(cpf);
		System.out.println("Digite o telefone: ");
		sc.nextLine();
		String telefone = sc.nextLine();
		clienteCad.setTelefone(telefone);
		System.out.println("Digite o endereço: ");
		String endereco = sc.nextLine();
		clienteCad.setEndereco(endereco);
		return clienteCad;
	}

	private static void MenuCliente() {
		System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
		System.out.println("\n                  ===========================================");
		System.out.println("                  |     1 - Cadastrar Cliente               |");
		System.out.println("                  |     2 - Listar Clientes                 |");
		System.out.println("                  |     3 - Editar Cliente                  |");
		System.out.println("                  |     4 - Excluir Cliente                 |");
		System.out.println("                  |     5 - Pesquisar Cliente               |");
		System.out.println("                  |     6 - Histórico de Pedidos do cliente |");
		System.out.println("                  |     0 - Voltar                          |");
		System.out.println("                  ===========================================\n");
	}

	public static void limpartela() {
		for (int i = 0; i < 50; ++i)
			System.out.println();
	}

}

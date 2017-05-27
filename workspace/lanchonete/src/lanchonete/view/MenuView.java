package lanchonete.view;

import java.math.BigDecimal;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Scanner;

import lanchonete.business.ClienteService;
import lanchonete.business.EstoqueService;
import lanchonete.business.UserService;
import lanchonete.model.ClienteModel;
import lanchonete.model.PedidoModel;
import lanchonete.model.ProdutoModel;
import lanchonete.model.UsuarioModel;

public class MenuView {
	private Scanner sc = new Scanner(System.in);
	private ClienteService clienteService = new ClienteService();
	private EstoqueService estoqueService = new EstoqueService();
	private UserService userService = new UserService();
	private int opcao = 0;

	public void menu(UsuarioModel user) throws ParseException {
		int perfil = user.getPerfil_user();
		if(perfil == 1){
			estoqueService.checarNivelEstoque(user.getQtd_alerta_estoque());
		}
		do {
			System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
			System.out.println("\n                  =========================================");
			System.out.println("                  |     1 - Realizar Pedido               |");
			if (perfil == 2)
				System.out.println("                  |     2 - Verifica Pedido               |");
			if (perfil == 2)
				System.out.println("                  |     3 - Checar Preço de Mercadoria    |");
			// proprietario
			if (perfil == 1)
				System.out.println("                  |     2 - Gerenciamento de Estoque      |");
			if (perfil == 1)
				System.out.println("                  |     3 - Gerenciamento de Clientes     |");
			if (perfil == 1)
				System.out.println("                  |     4 - Gerenciamento de Usuários     |");
			if (perfil == 1)
				System.out.println("                  |     5 - Gerenciamento de Mesas        |");
			System.out.println("                  |     0 - Sair                          |");
			System.out.println("                  =========================================\n");
			opcao = sc.nextInt();
			if (perfil == 1) {
				switch (opcao) {
				case 1:

					break;
				case 2:
					getSubmenu(2, user);
					break;
				case 3:
					getSubmenu(3, user);
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
			} else {
				switch (opcao) {
				case 1:

					break;
				case 2:

					break;
				case 3:

					break;
				case 0:
					break;
				default:
					System.out.println("Opção inválida!");
					break;
				}
			}
		} while (opcao != 0);
	}

	private void getSubmenu(int i, UsuarioModel user) throws ParseException {

		do {
			switch (i) {
			case 1:

				break;
			case 2:
				MenuEstoque(user);
				break;
			case 3:
				MenuCliente();
				break;
			case 4:

				break;
			case 5:

				break;
			}
		} while (opcao != 0);
	}

	private void MenuCliente() {
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
		int opcao = sc.nextInt();
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
			} else {
				System.out.println("Nenhum pedido encontrado");
			}
			break;
		case 0:
			break;
		default:
			System.out.println("Opção inválida!");
			break;
		}
	}

	private ClienteModel getDadosCliente() {
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

	private ProdutoModel getDadosProduto() throws ParseException {
		ProdutoModel p = new ProdutoModel();
		System.out.println("Digite o nome do produto: ");
		sc.nextLine();
		String nome = sc.nextLine();
		p.setNome_produto(nome);
		System.out.println("Digite o preço do produto: ");
		p.setPreco_produto(sc.nextBigDecimal());
		System.out.println("Digite a data de validade(dd/mm/aaaa). Caso não tenha digite -");
		sc.nextLine();
		String data = sc.nextLine();
		SimpleDateFormat formato = new SimpleDateFormat("dd/MM/yyyy");
		Date dataFormatada = formato.parse(data);
		p.setData_validade(dataFormatada);
		System.out.println("Digite a quantidade a ser cadastrada no estoque: ");
		p.setQtd_disponivel(sc.nextInt());
		return p;
	}

	private void MenuEstoque(UsuarioModel user) throws ParseException {
		System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
		System.out.println("\n                  =======================================================");
		System.out.println("                  |     1 - Cadastrar Produto                           |");
		System.out.println("                  |     2 - Listar Produtos                             |");
		System.out.println("                  |     3 - Editar Produto                              |");
		System.out.println("                  |     4 - Excluir Produto                             |");
		System.out.println("                  |     5 - Pesquisar Produto                           |");
		System.out.println("                  |     6 - Definir nível para alerta de estoque baixo  |");
		System.out.println("                  |     0 - Voltar                                      |");
		System.out.println("                  =======================================================\n");

		int opcao = sc.nextInt();
		switch (opcao) {
		case 1:
			ProdutoModel produtoCad = getDadosProduto();
			int returnSave = estoqueService.salvarProduto(produtoCad);
			if (returnSave > 0) {
				System.out.println("Produto Cadastrado com sucesso!!!");
			} else {
				System.out.println("Erro ao salvar Produto...");
			}
			break;
		case 2:
			estoqueService.listarProdutos();
			break;
		case 3:
			List<ProdutoModel> listaUpdate;
			System.out.println("Digite o código do produto: ");
			int codProduto = sc.nextInt();
			listaUpdate = estoqueService.getProduto(codProduto);
			if (listaUpdate.size() > 0) {
				EstoqueView e = new EstoqueView();
				e.listarProdutos(listaUpdate);
				ProdutoModel p = getDadosProduto();
				p.setCod_produto(codProduto);
				int returnUpdate = estoqueService.editarProduto(p);
				if (returnUpdate > 0) {
					System.out.println("Produto editado com sucesso!!!");
				} else {
					System.out.println("Erro ao editar Produto...");
				}
			} else {
				System.out.println("Código inválido");
			}
			break;
		case 4:
			System.out.println("Digite o código do produto: ");
			int returnDelete = estoqueService.excluirProduto(sc.nextInt());
			if (returnDelete > 0) {
				System.out.println("Produto excluído com sucesso!!!");
			} else {
				System.out.println("Erro ao excluir Produto...");
			}
			break;
		case 5:
			System.out.println("Digite o código do produto: ");
			List<ProdutoModel> listaProduto = estoqueService.getProduto(sc.nextInt());
			if (listaProduto.size() > 0) {
				EstoqueView estoqueView = new EstoqueView();
				estoqueView.listarProdutos(listaProduto);
			}
			break;
		case 6:
			System.out.println("Digite a quantidade que deseja ser avisado, sobre o nivel do estoque dos produtos: ");
			int nivel = sc.nextInt();
			int returnSave1 = userService.setLimiteAviso(nivel, user.getCod_user());
			if (returnSave1 > 0) {
				System.out.println("Limite cadastrado com sucesso!!!");
			} else {
				System.out.println("Erro ao cadastrar limite...");
			}
			break;

		default:
			break;
		}
	}

}

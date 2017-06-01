package lanchonete.view;

import java.math.BigDecimal;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Scanner;

import lanchonete.business.ClienteService;
import lanchonete.business.EstoqueService;
import lanchonete.business.MesaService;
import lanchonete.business.UserService;
import lanchonete.model.ClienteModel;
import lanchonete.model.MesaModel;
import lanchonete.model.PedidoModel;
import lanchonete.model.ProdutoModel;
import lanchonete.model.UsuarioModel;

public class MenuView {
	private Scanner sc = new Scanner(System.in);
	private ClienteService clienteService = new ClienteService();
	private EstoqueService estoqueService = new EstoqueService();
	private UserService userService = new UserService();
	private MesaService mesaService = new MesaService();
	private int opcao = 0;

	public void menu(UsuarioModel user) throws Exception {
		int perfil = user.getPerfil_user();
		if (perfil == 1) {
			estoqueService.checarNivelEstoque(user.getQtd_alerta_estoque());
			estoqueService.checarValidadeEstoque();
		}
		do {
			System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
			System.out.println("\n                  =========================================");
			System.out.println("                  |     1 - Realizar Pedido               |");
			if (perfil == 2)
				System.out.println("                  |     2 - Verifica Pedido               |");
			if (perfil == 2)
				System.out.println("                  |     3 - Checar Preço de Mercadoria    |");
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
					MenuEstoque(user);
					break;
				case 3:
					MenuCliente();
					break;
				case 4:
//					MenuUsuarios(user);
					break;
				case 5:
					MenuMesa();
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

	private void MenuCliente() {
		int opcaoCliente = 0;
		do {
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
			opcaoCliente = sc.nextInt();
			switch (opcaoCliente) {
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
				List<PedidoModel> listPedidosCliente = clienteService
						.buscarHistoricoPedidosCliente(sc.nextBigDecimal());
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
		} while (opcaoCliente != 0);
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
		Date dataFormatada;
		if (!data.equals("-")) {
			SimpleDateFormat formato = new SimpleDateFormat("dd/MM/yyyy");
			dataFormatada = formato.parse(data);
		} else {
			dataFormatada = null;
		}
		p.setData_validade(dataFormatada);
		System.out.println("Digite a quantidade a ser cadastrada no estoque: ");
		p.setQtd_disponivel(sc.nextInt());
		return p;
	}

	private void MenuEstoque(UsuarioModel user) throws ParseException {
		int opcaoEstoque = 0;
		do {
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

			opcaoEstoque = sc.nextInt();
			switch (opcaoEstoque) {
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
				System.out
						.println("Digite a quantidade que deseja ser avisado, sobre o nivel do estoque dos produtos: ");
				int nivel = sc.nextInt();
				int returnSave1 = userService.setLimiteAviso(nivel, user.getCod_user());
				if (returnSave1 > 0) {
					System.out.println("Limite cadastrado com sucesso!!!");
				} else {
					System.out.println("Erro ao cadastrar limite...");
				}
				break;
			case 0:
				break;

			default:
				System.out.println("Opção inválida");
				break;
			}
		} while (opcaoEstoque != 0);
	}

	private void MenuMesa() throws ParseException {
		int opcaoMesa = 0;
		do {
			System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
			System.out.println("\n                  =======================================================");
			System.out.println("                  |     1 - Cadastrar Mesa                              |");
			System.out.println("                  |     2 - Listar Mesas                                |");
			System.out.println("                  |     3 - Editar Mesa                                 |");
			System.out.println("                  |     4 - Excluir Mesa                                |");
			System.out.println("                  |     0 - Voltar                                      |");
			System.out.println("                  =======================================================\n");

			opcaoMesa = sc.nextInt();
			switch (opcaoMesa) {
			case 1:
				MesaModel mesaCad = new MesaModel();
				int returnSave = mesaService.cadastrarMesa(mesaCad);
				if (returnSave > 0) {
					System.out.println("Mesa Cadastrada com sucesso!!!");
				} else {
					System.out.println("Erro ao salvar Produto...");
				}
				break;
			case 2:
				mesaService.listarmesa();
				break;
			case 3:
				List<MesaModel> listaUpdate;
				System.out.println("Digite o número da mesa: ");
				int numMesa = sc.nextInt();
				listaUpdate = mesaService.getMesa(numMesa);
				if (listaUpdate.size() > 0) {
					MesaView e = new MesaView();
					e.listarMesa(listaUpdate);
					MesaModel p = new MesaModel();
					p.setCod_mesa(listaUpdate.get(0).getCod_mesa());
					System.out.println("Digite o status da mesa: Livre - 1 / Ocupada - 2 / Aguardando a conta - 3");
					int status = sc.nextInt();
					if (status == 1) {
						p.setStatus("Livre");
					} else if (status == 2) {
						p.setStatus("Ocupada");
					} else if (status == 3) {
						p.setStatus("Aguardando a conta");
					}
					int returnUpdate = mesaService.editarMesa(p);
					if (returnUpdate > 0) {
						System.out.println("Mesa editada com sucesso!!!");
					} else {
						System.out.println("Erro ao editar mesa...");
					}
				} else {
					System.out.println("Número inválido");
				}
				break;
			case 4:
				System.out.println("Digite o número da mesa: ");
				int returnDelete = mesaService.excluirMesa(sc.nextInt());
				if (returnDelete > 0) {
					System.out.println("Mesa excluída com sucesso!!!");
				} else {
					System.out.println("Erro ao excluir mesa...");
				}
				break;
			case 0:
				break;
			default:
				System.out.println("Opção inválida");
				break;
			}
		} while (opcaoMesa != 0);
	}

	private UsuarioModel getDadosUser() throws ParseException {
		UsuarioModel user = new UsuarioModel();
		System.out.println("Digite o nome do usuário: ");
		sc.nextLine();
		String nome = sc.nextLine();
		user.setNome_user(nome);
		System.out.println("Digite o cpf do usuario: ");
		user.setCpf_user(sc.nextLine());
		System.out.println("Digite o login do usuario: ");
		user.setLogin_user(sc.nextLine());
		System.out.println("Digite o perfil do usuario: 1-Proprietário / 2-Funcionário");
		user.setPerfil_user(sc.nextInt());

		return user;
	}

	private void MenuUsuarios(UsuarioModel user) throws ParseException {
		int opcaoUsuario = 0;
		do {
			System.out.println("\n\n            ### SISLANCHE - Sistema Gerencial De Lanchonetes ###");
			System.out.println("\n                  =======================================================");
			System.out.println("                  |     1 - Cadastrar Usuário                           |");
			System.out.println("                  |     2 - Listar Usuários                             |");
			System.out.println("                  |     3 - Editar Usuário                              |");
			System.out.println("                  |     4 - Excluir Usuário                             |");
			System.out.println("                  |     5 - Pesquisar Usuário                           |");
			System.out.println("                  |     6 - Definir nível para alerta de estoque baixo  |");
			System.out.println("                  |     7 - Trocar senha                                |");
			System.out.println("                  |     8 - Trocar perfil de usuário                    |");
			System.out.println("                  |     0 - Voltar                                      |");
			System.out.println("                  =======================================================\n");

			opcaoUsuario = sc.nextInt();
			switch (opcaoUsuario) {
			case 1:
				UsuarioModel userCad = getDadosUser();
				int returnSave = userService.salvarUsuario(userCad);
				if (returnSave > 0) {
					System.out.println("Usuário Cadastrado com sucesso./n A senha de acesso é igual ao login.");
				} else {
					System.out.println("Erro ao salvar usuário...");
				}
				break;
			case 2:
				userService.listarUsuarios();
				break;
			case 3:
				List<UsuarioModel> listaUpdate;
				System.out.println("Digite o código do usuário: ");
				int codUser = sc.nextInt();
				listaUpdate = userService.getUsuario(codUser);
				if (listaUpdate.size() > 0) {
					UsuarioView userView = new UsuarioView();
					userView.listarUsuarios(listaUpdate);
					UsuarioModel userUpdate = getDadosUser();
					userUpdate.setCod_user(codUser);
					int returnUpdate = userService.editarUsuario(userUpdate);
					if (returnUpdate > 0) {
						System.out.println("Usuário editado com sucesso!!!");
					} else {
						System.out.println("Erro ao editar usuário...");
					}
				} else {
					System.out.println("Código inválido");
				}
				break;
			case 4:
				System.out.println("Digite o código do usuário: ");
				int returnDelete = userService.excluirUsuario(sc.nextInt());
				if (returnDelete > 0) {
					System.out.println("Usuário excluído com sucesso!!!");
				} else {
					System.out.println("Erro ao excluir usuário...");
				}
				break;
			case 5:
				System.out.println("Digite o código do usuário: ");
				List<UsuarioModel> listaUser = userService.getUsuario(sc.nextInt());
				if (listaUser.size() > 0) {
					UsuarioView userView = new UsuarioView();
					userView.listarUsuarios(listaUser);
				}
				break;
			case 6:
				System.out
						.println("Digite a quantidade que deseja ser avisado, sobre o nivel do estoque dos produtos: ");
				int nivel = sc.nextInt();
				int returnSave1 = userService.setLimiteAviso(nivel, user.getCod_user());
				if (returnSave1 > 0) {
					System.out.println("Limite cadastrado com sucesso!!!");
				} else {
					System.out.println("Erro ao cadastrar limite...");
				}
				break;
			case 7:
				System.out.println("Digite sua senha antiga: ");
				String senhaAntiga = sc.nextLine();
				System.out.println("Digite a nova senha: ");
				String novaSenha = sc.nextLine();
				System.out.println("Confirme a nova senha: ");
				String confirmaSenha = sc.nextLine();
				if(confirmaSenha != novaSenha){
					System.out.println("Confirmação de senha não confere");
				}else{
					
				}
				
				int returnSenha = userService.setLimiteAviso(nivel, user.getCod_user());
				if (returnSenha > 0) {
					System.out.println("Limite cadastrado com sucesso!!!");
				} else {
					System.out.println("Erro ao cadastrar limite...");
				}
				break;
			case 8:
				System.out
						.println("Digite a quantidade que deseja ser avisado, sobre o nivel do estoque dos produtos: ");
				int nivel1 = sc.nextInt();
				int returnSave2 = userService.setLimiteAviso(nivel1, user.getCod_user());
				if (returnSave2 > 0) {
					System.out.println("Limite cadastrado com sucesso!!!");
				} else {
					System.out.println("Erro ao cadastrar limite...");
				}
				break;
			case 0:
				break;

			default:
				System.out.println("Opção inválida");
				break;
			}
		} while (opcaoUsuario != 0);
	}

}

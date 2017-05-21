package lanchonete.view;

import java.util.List;

import lanchonete.model.ClienteModel;
import lanchonete.model.PedidoModel;
import lanchonete.model.ProdutoModel;

public class ClienteView {

	public void listarCliente(List<ClienteModel> lista) {
		System.out.println(
				"---------------------------------------- Lista de Clientes -------------------------------------");
		if (!lista.isEmpty()) {
			for (int i = 0; i < lista.size(); i++) {
				System.out.println("C�digo do cliente: " + lista.get(i).getCodigoCliente());
				System.out.println("C�digo do nome: " + lista.get(i).getNome());
				System.out.println("C�digo do telefone: " + lista.get(i).getTelefone());
				System.out.println("C�digo do CPF: " + lista.get(i).getCpf());
				System.out.println("C�digo do endere�o: " + lista.get(i).getEndereco());
				if (i != lista.size() - 1) {
					System.out.println(
							"------------------------------------------------------------------------------------------------");
				}
			}
		} else {
			System.out.println("Nenhum cliente cadastrado.");
		}
		System.out.println(
				"------------------------------------------------------------------------------------------------");
	}

	public void listarPedidosCliente(List<PedidoModel> lista) {
		System.out.println(
				"------------------------------ Lista de Pedidos do cliente -------------------------------------");
		if (!lista.isEmpty()) {
			for (int i = 0; i < lista.size(); i++) {
				System.out.println("C�digo do pedido: " + lista.get(i).getCod_pedido());
				System.out.println("Data do Pedido: " + lista.get(i).getData_pedido());
				System.out.println("Total do Pedido: " + lista.get(i).getTotal());
				System.out.println("------------------------Dados do Cliente------------------------");
				System.out.println("C�digo do cliente: " + lista.get(i).getCliente().getCodigoCliente());
				System.out.println("Nome do cliente: " + lista.get(i).getCliente().getNome());
				if (lista.get(i).getProdutos().size() > 0) {
					System.out.println("-------------------------Itens do pedido-------------------------");
					for (int j = 0; j < lista.get(i).getProdutos().size(); j++) {
						System.out.println("Nome do produto: " + lista.get(i).getProdutos().get(j).getNome_produto());
						System.out.println("Pre�o do produto: " + lista.get(i).getProdutos().get(j).getPreco_produto());
						if (j != lista.get(i).getProdutos().size() - 1) {
							System.out.println("-----------------------------------------------------------------");
						}
					}
				}
				if (i != lista.size() - 1) {
					System.out.println(
							"------------------------------------------------------------------------------------------------");
				}
			}
		} else {
			System.out.println("Nenhum pedido encontrado.");
		}
		System.out.println(
				"------------------------------------------------------------------------------------------------");

	}

}

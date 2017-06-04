package lanchonete.view;

import java.util.List;

import lanchonete.model.PedidoModel;

public class PedidoView {
	
	public void listarPedidos(List<PedidoModel> lista) {
		if (!lista.isEmpty()) {
			for (int i = 0; i < lista.size(); i++) {
				System.out.println("------------------------------ Pedido N° " + lista.get(i).getCod_pedido()
						+ " -------------------------------------");
				System.out.print("Data do Pedido: " + lista.get(i).getData_pedido()+" / ");
				if(lista.get(i).getStatus_pedido() == 1) System.out.print("Aberto / "); else System.out.print("Encerrado / ");
				System.out.println("Total do Pedido: " + lista.get(i).getTotal());
				System.out.println("------------------------Dados do Cliente------------------------");
				System.out.print("Código : " + lista.get(i).getCliente().getCodigoCliente()+" / ");
				System.out.println("Nome do cliente: " + lista.get(i).getCliente().getNome());
				if (lista.get(i).getProdutos().size() > 0) {
					System.out.println("-------------------------Itens do pedido-------------------------");
					for (int j = 0; j < lista.get(i).getProdutos().size(); j++) {
						System.out.print("Nome : " + lista.get(i).getProdutos().get(j).getNome_produto() + " / ");
						System.out.print("Quantidade : " + lista.get(i).getProdutos().get(j).getQuantidade() + " / ");
						System.out.println("Preço : " + lista.get(i).getProdutos().get(j).getPreco_produto());
						if (j != lista.get(i).getProdutos().size() - 1) {
							System.out.println("-----------------------------------------------------------------");
						}
					}
				}
				if (i != lista.size() - 1)
					System.out.println("\n\n");
			}
		} else {
			System.out.println("Nenhum pedido encontrado.");
		}
		System.out.println(
				"---------------------------------------------------------------------------------");

	}
}

package lanchonete.business;

import java.util.ArrayList;
import java.util.List;

import lanchonete.DAO.PedidoDao;
import lanchonete.model.PedidoModel;

public class PedidoService {
	PedidoDao dao = new PedidoDao();
	
	public List<PedidoModel> buscarPedido(int codPedido) {
		PedidoModel pedido = new PedidoModel();
		List<PedidoModel> ListPedido = new ArrayList<PedidoModel>();
		try {
			pedido = dao.getPedido(codPedido);
			if(pedido.getCod_pedido() > 0){
				ListPedido.add(pedido);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return ListPedido;
	}
	
	public int realizarPedidos(PedidoModel pedido) {
		int retorno = 0;
		try {
			retorno = dao.realizarPedido(pedido);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int encerrarPedido(int codPedido) {
		int retorno = 0;
		try {
			retorno = dao.encerrarPedido(codPedido);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
	public int excluirPedido(int codPedido) {
		int retorno = 0;
		try {
			retorno = dao.excluirPedido(codPedido);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return retorno;
	}
	
}
